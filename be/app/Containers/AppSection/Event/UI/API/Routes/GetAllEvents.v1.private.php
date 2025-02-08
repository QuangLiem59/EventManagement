<?php

/**
 * @apiGroup           Event
 * @apiName            GetAllEvents
 *
 * @api                {GET} /v1/events Get All Events
 *
 * @apiVersion         1.0.0
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

use App\Containers\AppSection\Event\UI\API\Controllers\GetAllEventsController;
use Illuminate\Support\Facades\Route;

Route::get('events', [GetAllEventsController::class, 'getAllEvents']);
