<?php

namespace App\Containers\AppSection\Event\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Event\Actions\CreateEventAction;
use App\Containers\AppSection\Event\UI\API\Requests\CreateEventRequest;
use App\Containers\AppSection\Event\UI\API\Transformers\EventTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateEventController extends ApiController
{
    /**
     * @param CreateEventRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function createEvent(CreateEventRequest $request): JsonResponse
    {
        $event = app(CreateEventAction::class)->run($request)->refresh();

        return $this->created($this->transform($event, EventTransformer::class));
    }
}
