<?php
/**
 * @apiGroup           Authentication
 * @apiName            Logout
 * @api                {DELETE} /v1/logout Logout
 * @apiDescription     User Logout. (Revoking Access Token)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiUse             GeneralAcceptedResponse
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::delete('logout', [LogoutController::class, 'logout'])
    ->middleware(['auth:api']);

