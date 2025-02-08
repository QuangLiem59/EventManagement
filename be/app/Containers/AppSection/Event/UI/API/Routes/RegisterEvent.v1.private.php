<?php

/**
 * @apiGroup           Event
 * @apiName            RegisterEvent
 *
 * @api                {POST} /v1/events/:id/register Register Event
 *
 * @apiVersion         1.0.0
 *
 * @apiHeader          {String} accept=application/json
 * 
 * @apiParam           {Number} id
 * 
 * @apiBody            {String}  name
 * @apiBody            {String=male,female,unspecified} [gender=unspecified]
 * @apiBody            {String}  email
 * @apiBody            {String}  phone
 *
 * @apiUse             EventSuccessSingleResponse
 */

use App\Containers\AppSection\Event\UI\API\Controllers\RegisterEventController;
use Illuminate\Support\Facades\Route;

Route::post('events/{id}/register', [RegisterEventController::class, 'registerEvent']);
