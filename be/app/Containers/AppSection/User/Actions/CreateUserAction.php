<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\CreateUserTask;
use App\Containers\AppSection\User\UI\API\Requests\CreateUserRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Throwable;

class CreateUserAction extends ParentAction
{
    /**
     * @param CreateUserRequest $request
     * @return User
     * @throws CreateResourceFailedException
     * @throws Throwable
     * @throws NotFoundException
     */
    public function run(CreateUserRequest $request): User
    {
        $data = $request->sanitizeInput([
            'name',
            'username',
            'email',
            'phone',
            'password',
            'gender',
            'birthday',
            'avatar',
            'address',
        ]);

        return app(CreateUserTask::class)->run($data);
    }
}
