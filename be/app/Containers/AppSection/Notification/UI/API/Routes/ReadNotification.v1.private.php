<?php

/**
 * @apiGroup           Notification
 * @apiName            ReadNotification
 *
 * @api                {PATCH} /v1/notifications/read Read Notification
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiBody            {String} [id] Notification ID
 * 
 * @apiUse             GeneralNoContentResponse
 */

use App\Containers\AppSection\Notification\UI\API\Controllers\ReadNotificationController;
use Illuminate\Support\Facades\Route;

Route::patch('notifications/read', [ReadNotificationController::class, 'readNotification'])
    ->middleware(['auth:api']);

