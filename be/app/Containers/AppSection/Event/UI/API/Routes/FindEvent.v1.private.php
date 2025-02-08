<?php

/**
 * @apiGroup           Event
 * @apiName            FindEvent
 *
 * @api                {GET} /v1/events/:id Find Event
 *
 * @apiVersion         1.0.0
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {Number} id
 *
 * @apiUse             EventSuccessSingleResponse
 */

use App\Containers\AppSection\Event\UI\API\Controllers\FindEventController;
use Illuminate\Support\Facades\Route;

Route::get('events/{id}', [FindEventController::class, 'findEvent']);
