<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Containers\AppSection\User\Tasks\GetAllUsersTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class SyncUserRolesAction extends ParentAction
{
    /**
     * @param SyncUserRolesRequest $request
     * @return mixed
     * @throws NotFoundException
     */
    public function run(SyncUserRolesRequest $request): mixed
    {
        $rolesIds = (array)$request->roles_ids;

        $roles = array_map(static function ($roleId) {
            return app(FindRoleTask::class)->run($roleId);
        }, $rolesIds);

        $usersIds = [];
        if ($request->has('user_id')) {
            $usersIds = [$request->user_id];
        } else {
            $usersIds = (array)$request->users_ids;
        }

        foreach ($usersIds as $userId) {
            $user = app(FindUserByIdTask::class)->run($userId);
            $user->syncRoles($roles);
        }

        return app(GetAllUsersTask::class)->run(ids: $usersIds);
    }
}
