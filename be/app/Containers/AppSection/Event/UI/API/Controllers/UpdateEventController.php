<?php

namespace App\Containers\AppSection\Event\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Event\Actions\UpdateEventAction;
use App\Containers\AppSection\Event\UI\API\Requests\UpdateEventRequest;
use App\Containers\AppSection\Event\UI\API\Transformers\EventTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateEventController extends ApiController
{
    /**
     * @param UpdateEventRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function updateEvent(UpdateEventRequest $request): array
    {
        $event = app(UpdateEventAction::class)->run($request);

        return $this->transform($event, EventTransformer::class);
    }
}
