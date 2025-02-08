<?php

/**
 * @apiGroup           Authentication
 * @apiName            ResetPassword
 *
 * @api                {GET/POST} /v1/password/reset Reset Password
 * @apiDescription     Resets password of a user.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Unauthenticated
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiBody           {String} email
 * @apiBody           {String} token from the forgot password email
 * @apiBody           {String} password min: 5
 *
 * @apiUse            GeneralNoContentResponse
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::any('password/reset', [ResetPasswordController::class, 'resetPassword'])
    ->middleware(['guest']);
