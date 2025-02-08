<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\File\Tasks\DeleteFileTask;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class DeleteUserTask extends ParentTask
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param $id
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run($id): int
    {
        try {
            if ($id == 1) {
                throw new Exception(trans('error.user.delete_admin'));
            }

            $user = $this->repository->find($id);

            $deleted = $this->repository->delete($id);

            if ($user->avatar) {
                app(DeleteFileTask::class)->run($user->avatar);
            }

            return $deleted;
        } catch (Exception $e) {
            throw new DeleteResourceFailedException($e->getMessage());
        }
    }
}
