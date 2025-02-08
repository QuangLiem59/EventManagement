<?php

namespace App\Containers\AppSection\Event\Tasks;

use App\Containers\AppSection\Event\Data\Repositories\EventRepository;
use App\Containers\AppSection\Event\Models\Event;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindEventTask extends ParentTask
{
    public function __construct(
        protected EventRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Event
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
