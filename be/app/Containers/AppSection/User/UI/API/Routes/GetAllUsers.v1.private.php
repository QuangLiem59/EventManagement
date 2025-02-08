<?php

/**
 * @apiGroup           User
 * @apiName            GetAllUsers
 * @api                {GET} /v1/users Get All Users
 * @apiDescription     Get All Application Users. Add param ?include=roles to getting list roles of User
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-users', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 * 
 * @apiQuery           {String="has","no"} [searchRole]
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\GetAllUsersController;
use Illuminate\Support\Facades\Route;

Route::get('users', [GetAllUsersController::class, 'getAllUsers'])
    ->middleware(['auth:api']);
