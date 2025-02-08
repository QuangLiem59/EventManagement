<?php

namespace App\Containers\AppSection\Event\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Event\Models\Event;
use App\Containers\AppSection\Event\Tasks\UpdateEventTask;
use App\Containers\AppSection\Event\UI\API\Requests\UpdateEventRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateEventAction extends ParentAction
{
    /**
     * @param UpdateEventRequest $request
     * @return Event
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateEventRequest $request): Event
    {
        $data = $request->sanitizeInput([
            'title',
            'content',
            'date',
            'location',
            'capacity',
        ]);

        return app(UpdateEventTask::class)->run($data, $request->id);
    }
}
