<?php

namespace App\Containers\AppSection\Event\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Event\Models\EventRegister;
use App\Containers\AppSection\Event\Tasks\RegisterEventTask;
use App\Containers\AppSection\Event\UI\API\Requests\RegisterEventRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class RegisterEventAction extends ParentAction
{
    /**
     * @param RegisterEventRequest $request
     * @return EventRegister
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(RegisterEventRequest $request): EventRegister
    {
        $data = $request->sanitizeInput([
            'name',
            'gender',
            'email',
            'phone',
        ]);
        $data['event_id'] = $request->id;

        return app(RegisterEventTask::class)->run($data);
    }
}
