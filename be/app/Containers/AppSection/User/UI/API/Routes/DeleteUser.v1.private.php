<?php

/**
 * @apiGroup           User
 * @apiName            DeleteUser
 * @api                {DELETE} /v1/users/:id Delete User
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-users', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {Number} id user id
 *
 * @apiUse             GeneralNoContentResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\DeleteUserController;
use Illuminate\Support\Facades\Route;

Route::delete('users/{id}', [DeleteUserController::class, 'deleteUser'])
    ->middleware(['auth:api']);
