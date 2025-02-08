<?php

/**
 * @apiGroup           Event
 * @apiName            CreateEvent
 *
 * @api                {POST} /v1/events Create Event
 *
 * @apiVersion         1.0.0
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 * 
 * @apiBody            {String}  title
 * @apiBody            {String}  content
 * @apiBody            {Date}    date
 * @apiBody            {String}  location
 * @apiBody            {Integer} capacity
 *
 * @apiUse             EventSuccessSingleResponse
 */

use App\Containers\AppSection\Event\UI\API\Controllers\CreateEventController;
use Illuminate\Support\Facades\Route;

Route::post('events', [CreateEventController::class, 'createEvent']);
