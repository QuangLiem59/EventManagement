<?php

/**
 * @apiGroup           Notification
 * @apiName            GetMyNotifications
 *
 * @api                {GET} /v1/notifications Get My Notifications
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 * 
 * @apiQuery           {String="default"} [type]
 * @apiQuery           {String="read","unread"} [status]
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

use App\Containers\AppSection\Notification\UI\API\Controllers\GetAllNotificationsController;
use Illuminate\Support\Facades\Route;

Route::get('notifications', [GetAllNotificationsController::class, 'getAllNotifications'])
    ->middleware(['auth:api']);

