<?php

namespace App\Containers\AppSection\Event\Actions;

use App\Containers\AppSection\Event\Models\Event;
use App\Containers\AppSection\Event\Tasks\FindEventTask;
use App\Containers\AppSection\Event\UI\API\Requests\FindEventRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindEventAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindEventRequest $request): Event
    {
        return app(FindEventTask::class)->run($request->id);
    }
}
