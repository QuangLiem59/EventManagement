<?php

/**
 * @apiGroup           Event
 * @apiName            DeleteEvent
 *
 * @api                {DELETE} /v1/events/:id Delete Event
 *
 * @apiVersion         1.0.0
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 * 
 * @apiParam           {Number} id
 *
 * @apiUse             GeneralNoContentResponse
 */

use App\Containers\AppSection\Event\UI\API\Controllers\DeleteEventController;
use Illuminate\Support\Facades\Route;

Route::delete('events/{id}', [DeleteEventController::class, 'deleteEvent']);
