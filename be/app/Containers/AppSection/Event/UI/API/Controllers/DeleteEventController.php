<?php

namespace App\Containers\AppSection\Event\UI\API\Controllers;

use App\Containers\AppSection\Event\Actions\DeleteEventAction;
use App\Containers\AppSection\Event\UI\API\Requests\DeleteEventRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteEventController extends ApiController
{
    /**
     * @param DeleteEventRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteEvent(DeleteEventRequest $request): JsonResponse
    {
        app(DeleteEventAction::class)->run($request);

        return $this->noContent();
    }
}
