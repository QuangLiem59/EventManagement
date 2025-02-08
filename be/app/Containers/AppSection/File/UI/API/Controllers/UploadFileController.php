<?php

namespace App\Containers\AppSection\File\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\File\Actions\UploadFileAction;
use App\Containers\AppSection\File\UI\API\Requests\UploadFileRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class UploadFileController extends ApiController
{
    /**
     * @param UploadFileRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function uploadFile(UploadFileRequest $request): JsonResponse
    {
        $data = app(UploadFileAction::class)->run($request);

        return $this->json(['data' => $data]);
    }
}
