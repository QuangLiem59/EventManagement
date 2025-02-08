<?php

namespace App\Containers\AppSection\Event\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Event\Models\Event;
use App\Containers\AppSection\Event\Tasks\CreateEventTask;
use App\Containers\AppSection\Event\UI\API\Requests\CreateEventRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateEventAction extends ParentAction
{
    /**
     * @param CreateEventRequest $request
     * @return Event
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateEventRequest $request): Event
    {
        $data = $request->sanitizeInput([
            'title',
            'content',
            'date',
            'location',
            'capacity',
        ]);

        return app(CreateEventTask::class)->run($data);
    }
}
