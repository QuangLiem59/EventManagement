<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\DeletePermissionTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeletePermissionRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeletePermissionAction extends ParentAction
{
    /**
     * @param DeletePermissionRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeletePermissionRequest $request): int
    {
        return app(DeletePermissionTask::class)->run($request->id);
    }
}
