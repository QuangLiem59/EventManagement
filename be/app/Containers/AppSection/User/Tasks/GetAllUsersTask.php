<?php

namespace App\Containers\AppSection\User\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllUsersTask extends ParentTask
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param string $searchRole
     * @return mixed
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(string $searchRole = '', array $ids = []): mixed
    {
        $repository = $this->addRequestCriteria()->repository;
        
        $table = config('permission.table_names.model_has_roles');
        if ($searchRole == 'has') {
            $repository = $repository->whereIn('id', function($query) use ($table) {
                $query->select('model_id')->from($table)->where('model_type', User::class);
            });
        } elseif ($searchRole == 'no') {
            $repository = $repository->whereNotIn('id', function($query) use ($table) {
                $query->select('model_id')->from($table)->where('model_type', User::class);
            });
        }

        if (!empty($ids)) {
            $repository = $repository->whereIn('id', $ids);
        }

        return $repository->paginate();
    }
}
