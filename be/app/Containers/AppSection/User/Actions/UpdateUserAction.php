<?php

namespace App\Containers\AppSection\User\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateUserAction extends ParentAction
{
    /**
     * @param UpdateUserRequest $request
     * @return User
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(UpdateUserRequest $request): User
    {
        $data = $request->sanitizeInput([
            'name',
            'username',
            'email',
            'phone',
            'password',
            'gender',
            'birthday',
            'address',
            'avatar',
            'status',
            'fcm_token',
        ]);

        return app(UpdateUserTask::class)->run($data, $request->id, $request->user()->id);
    }
}
