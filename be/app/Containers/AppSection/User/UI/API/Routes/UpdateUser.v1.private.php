<?php

/**
 * @apiGroup           User
 * @apiName            UpdateUser
 * @api                {PATCH} /v1/users/:id Update User
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-users', 'roles' => ''] | isResourceOwner
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {Number} id user id
 *
 * @apiBody            {String{2..200}} [name]
 * @apiBody            {String{4..50}} [username] Unique
 * @apiBody            {String{..200}} [email] Nullable. Unique
 * @apiBody            {String} [phone] Nullable. Unique
 * @apiBody            {String{4..50}} [password]
 * @apiBody            {String="male","female","unspecified"} [gender]
 * @apiBody            {Date} [birthday] Nullable. Format: `Y-m-d` / e.g 2015-10-15
 * @apiBody            {URL{..250}} [avatar] Nullable
 * @apiBody            {String{..400}} [address]
 * @apiBody            {String="enable","disable"} [status]
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::patch('users/{id}', [UpdateUserController::class, 'updateUser'])
    ->middleware(['auth:api']);
