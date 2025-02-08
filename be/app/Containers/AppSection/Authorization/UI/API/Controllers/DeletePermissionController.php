<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\DeletePermissionAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeletePermissionRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeletePermissionController extends ApiController
{
    /**
     * @param DeletePermissionRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deletePermission(DeletePermissionRequest $request): JsonResponse
    {
        app(DeletePermissionAction::class)->run($request);

        return $this->noContent();
    }
}
