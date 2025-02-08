<?php

namespace App\Containers\AppSection\Event\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Event\Tasks\GetAllEventsTask;
use App\Containers\AppSection\Event\UI\API\Requests\GetAllEventsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllEventsAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllEventsRequest $request): mixed
    {
        return app(GetAllEventsTask::class)->run();
    }
}
