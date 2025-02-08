<?php

namespace App\Containers\AppSection\Event\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Event\Actions\RegisterEventAction;
use App\Containers\AppSection\Event\UI\API\Requests\RegisterEventRequest;
use App\Containers\AppSection\Event\UI\API\Transformers\EventRegisterTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class RegisterEventController extends ApiController
{
    /**
     * @param RegisterEventRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function registerEvent(RegisterEventRequest $request): JsonResponse
    {
        $eventRegister = app(RegisterEventAction::class)->run($request)->refresh();

        return $this->created($this->transform($eventRegister, EventRegisterTransformer::class));
    }
}
