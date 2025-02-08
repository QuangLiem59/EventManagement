<?php

namespace App\Containers\AppSection\User\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserPasswordRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateUserPasswordAction extends ParentAction
{
    /**
     * @param UpdateUserPasswordRequest $request
     * @return User
     * @throws IncorrectIdException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(UpdateUserPasswordRequest $request): User
    {
        $data = $request->sanitizeInput([
            'new_password',
        ]);

        $user = app(UpdateUserTask::class)->run([
            'password' => $data['new_password']
        ], $request->id, $request->user()->id);

        return $user;
    }
}
