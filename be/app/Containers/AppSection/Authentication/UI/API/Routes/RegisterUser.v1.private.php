<?php

/**
 * @apiGroup           Authentication
 * @apiName            RegisterUser
 * @api                {POST} /v1/register Register
 * @apiDescription     Register users
 *
 * @apiVersion         1.0.0
 * @apiPermission      Unauthenticated
 *
 * @apiHeader          {String} accept=application/json
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

use App\Containers\AppSection\Authentication\UI\API\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterUserController::class, 'registerUser'])
    ->middleware(['guest']);
