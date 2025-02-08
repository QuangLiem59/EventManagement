<?php

namespace App\Containers\AppSection\Event\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Event\Actions\FindEventAction;
use App\Containers\AppSection\Event\UI\API\Requests\FindEventRequest;
use App\Containers\AppSection\Event\UI\API\Transformers\EventTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindEventController extends ApiController
{
    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function findEvent(FindEventRequest $request): array
    {
        $event = app(FindEventAction::class)->run($request);

        return $this->transform($event, EventTransformer::class);
    }
}
