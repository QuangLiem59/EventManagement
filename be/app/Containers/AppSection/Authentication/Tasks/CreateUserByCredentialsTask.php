<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Support\Facades\Hash;

class CreateUserByCredentialsTask extends ParentTask
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data, array $roleNames = []): User
    {
        if (array_key_exists('avatar', $data)) {
            $data['avatar'] = md_storage_path($data['avatar']);
        }

        $data['password'] = Hash::make($data['password']);

        try {
            $user = $this->repository->create($data);

            if (!empty($roleNames)) {
                foreach ($roleNames as $_name => $_guard) {
                    $role = app(FindRoleTask::class)->run($_name, $_guard);
                    if ($role) {
                        app(AssignRolesToUserTask::class)->run($user, $role);
                    }
                }

                $user->save();
            }
        } catch (Exception $e) {
            throw new CreateResourceFailedException($e->getMessage());
        }

        return $user;
    }
}
