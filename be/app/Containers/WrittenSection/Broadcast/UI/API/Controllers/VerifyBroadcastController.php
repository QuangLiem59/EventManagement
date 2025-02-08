<?php

namespace App\Containers\WrittenSection\Broadcast\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\WrittenSection\Broadcast\Actions\VerifyBroadcastAction;
use App\Containers\WrittenSection\Broadcast\UI\API\Requests\VerifyBroadcastRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class VerifyBroadcastController extends ApiController
{
    /**
     * @param VerifyBroadcastRequest $request
     * @return JsonResponse
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function verifyBroadcast(VerifyBroadcastRequest $request): JsonResponse
    {
        app(VerifyBroadcastAction::class)->run($request);

        return $this->noContent();
    }
}
