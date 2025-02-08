<?php

/**
 * @apiGroup           Authentication
 * @apiName            ForgotPassword
 *
 * @api                {POST} /v1/password/forgot Forgot password
 * @apiDescription     Forgot password endpoint.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Unauthenticated
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiBody            {String} email
 * @apiBody            {String="[host]/password/reset"} reseturl
 *
 * @apiUse             GeneralNoContentResponse
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

Route::post('password/forgot', [ForgotPasswordController::class, 'forgotPassword'])
    ->middleware(['guest']);
