<?php

/**
 * @apiGroup           Event
 * @apiName            UpdateEvent
 *
 * @api                {PATCH} /v1/events/:id Update Event
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-events', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {Number} id
 * 
 * @apiBody            {String}  [title]
 * @apiBody            {String}  [content]
 * @apiBody            {Date}    [date]
 * @apiBody            {String}  [location]
 * @apiBody            {Integer} [capacity]
 *
 * @apiUse             EventSuccessSingleResponse
 */

use App\Containers\AppSection\Event\UI\API\Controllers\UpdateEventController;
use Illuminate\Support\Facades\Route;

Route::patch('events/{id}', [UpdateEventController::class, 'updateEvent']);
