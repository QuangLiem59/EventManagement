<?php

use App\Containers\WrittenSection\Broadcast\UI\API\Controllers\VerifyBroadcastController;
use Illuminate\Support\Facades\Route;

Route::post('broadcast/auth', [VerifyBroadcastController::class, 'verifyBroadcast']);
