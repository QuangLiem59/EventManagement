<?php

namespace App\Containers\AppSection\Notification\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Notification\Actions\ReadNotificationAction;
use App\Containers\AppSection\Notification\UI\API\Requests\ReadNotificationRequest;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class ReadNotificationController extends ApiController
{
    /**
     * @param ReadNotificationRequest $request
     * @return JsonResponse
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     */
    public function readNotification(ReadNotificationRequest $request): JsonResponse
    {
        app(ReadNotificationAction::class)->run($request);

        return $this->noContent();
    }
}
