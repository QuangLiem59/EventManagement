<?php

namespace App\Containers\AppSection\Event\Tasks;

use App\Containers\AppSection\Event\Data\Repositories\EventRegisterRepository;
use App\Containers\AppSection\Event\Data\Repositories\EventRepository;
use App\Containers\AppSection\Event\Models\EventRegister;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Support\Facades\DB;

class RegisterEventTask extends ParentTask
{
    public function __construct(
        protected EventRegisterRepository $repository
    ) {}

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): EventRegister
    {
        try {
            DB::beginTransaction();
            $event = EventRepository::instance()->find($data['event_id']);

            if ($event->register()->count() >= $event->capacity) {
                throw new CreateResourceFailedException('Event is full');
            }

            $register = $this->repository->create($data);
            DB::commit();
            return $register;
        } catch (Exception $e) {
            DB::rollBack();
            throw new CreateResourceFailedException($e->getMessage());
        }
    }
}
