<?php

/**
 * @apiGroup           User
 * @apiName            CreateUser
 *
 * @api                {POST} /v1/users Create User
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-users', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiBody            {String{2..200}} name
 * @apiBody            {String{4..50}} username Unique
 * @apiBody            {String{..200}} [email] Unique
 * @apiBody            {String} [phone] Unique
 * @apiBody            {String{5..50}} password
 * @apiBody            {String="male","female","unspecified"} [gender]
 * @apiBody            {Date} [birthday] Format: `Y-m-d`
 * @apiBody            {URL{..250}} [avatar]
 * @apiBody            {String{..400}} [address]
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\CreateUserController;
use Illuminate\Support\Facades\Route;

Route::post('users', [CreateUserController::class, 'createUser'])
    ->middleware(['auth:api']);

