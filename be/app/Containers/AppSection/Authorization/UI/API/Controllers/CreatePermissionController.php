<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\CreatePermissionAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreatePermissionRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreatePermissionController extends ApiController
{
    /**
     * @param CreatePermissionRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function createPermission(CreatePermissionRequest $request): JsonResponse
    {
        $authorization = app(CreatePermissionAction::class)->run($request)->refresh();

        return $this->created($this->transform($authorization, PermissionTransformer::class));
    }
}
