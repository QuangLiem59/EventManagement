<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\File\Tasks\DeleteFileTask;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Arr;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UpdateUserTask extends ParentTask
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param array $userData
     * @param integer $userId
     * @param integer $requestUserId
     * @return User
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $userData, $userId, $requestUserId): User
    {
        try {
            $user = $this->repository->find($userId);

            if ($userId != $requestUserId) {
                if ($userId == 1) {
                    throw new Exception(trans('error.user.update_admin'));
                }
            } elseif (array_key_exists('status', $userData)) {
                unset($userData['status']);
            }

            if (array_key_exists('password', $userData)) {
                $userData['password'] = Hash::make($userData['password']);
            }

            if (array_key_exists('avatar', $userData)) {
                $userData['avatar'] = md_storage_path($userData['avatar']);
                if ($user->avatar != $userData['avatar']) {
                    app(DeleteFileTask::class)->run($user->avatar);
                }
            }

            $updated = $this->repository->update($userData, $userId);

            if ($userId != $requestUserId) {
                if (Arr::get($userData, 'status') == 'disable' or array_key_exists('password', $userData)) {
                    User::logoutAuthByIdAllDevices($userId);
                }
            }

            return $updated;
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception $e) {
            throw new UpdateResourceFailedException($e->getMessage());
        }
    }
}
