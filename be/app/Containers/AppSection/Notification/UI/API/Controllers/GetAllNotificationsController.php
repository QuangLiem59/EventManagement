<?php

namespace App\Containers\AppSection\Notification\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Notification\Actions\GetAllNotificationsAction;
use App\Containers\AppSection\Notification\UI\API\Requests\GetAllNotificationsRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllNotificationsController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllNotifications(GetAllNotificationsRequest $request): JsonResponse
    {
        $data = app(GetAllNotificationsAction::class)->run($request);

        return $this->json($data);
    }
}
