<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Criterias\ThisConditionThatCriteria;
use App\Ship\Criterias\ThisEqualThatCriteria;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPermissionsTask extends ParentTask
{
    public function __construct(
        protected PermissionRepository $repository
    ) {
    }

    /**
     * @param bool $skipPagination
     * @param string $guardName
     * @return mixed
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(bool $skipPagination = false, string $guardName = '', array $excludes = []): mixed
    {
        $repository = $this->addRequestCriteria()->repository;
        
        if ($guardName) {
            $repository->pushCriteria(new ThisEqualThatCriteria('guard_name', $guardName));
        }

        if (!empty($excludes)) {
            $repository->pushCriteria(new ThisConditionThatCriteria('name', 'notin', $excludes));
        }

        return $skipPagination ? $repository->get() : $repository->paginate();
    }
}
