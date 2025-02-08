<?php

namespace App\Containers\WrittenSection\Broadcast\Actions;

use App\Containers\WrittenSection\Broadcast\Classes\Broadcast;
use App\Containers\WrittenSection\Broadcast\UI\API\Requests\VerifyBroadcastRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class VerifyBroadcastAction extends ParentAction
{
    public function run(VerifyBroadcastRequest $request): mixed
    {
        if (!Broadcast::auth($request)) {
            abort(405);
        }

        return true;
    }
}
