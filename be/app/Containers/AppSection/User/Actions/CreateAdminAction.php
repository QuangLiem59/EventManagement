<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateAdminAction extends ParentAction
{
    /**
     * @param array $data
     * @return User
     * @throws CreateResourceFailedException
     * @throws Throwable
     * @throws NotFoundException
     */
    public function run(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $adminRoleName = config('appSection-authorization.admin_role');
            $docsRoleName = config('appSection-authorization.docs_role');

            return app(CreateUserByCredentialsTask::class)->run($data, [
                $docsRoleName => 'web',
                $adminRoleName => 'api'
            ]);
        });
    }
}
