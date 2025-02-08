<?php

/**
 * @apiGroup           User
 * @apiName            UpdateUserPassword
 * @api                {PATCH} /v1/users/:id/password Update User's Password
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-users', 'roles' => ''] | isResourceOwner
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {Number} id user id
 *
 * @apiBody            {String} current_password
 * @apiBody            {String} new_password min: 5 (bao gồm: chữ thường, chữ hoa, chữ số và ký tự đặc biệt)
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\UpdateUserPasswordController;
use Illuminate\Support\Facades\Route;

Route::patch('users/{id}/password', [UpdateUserPasswordController::class, 'updateUserPassword'])
    ->middleware(['auth:api']);
