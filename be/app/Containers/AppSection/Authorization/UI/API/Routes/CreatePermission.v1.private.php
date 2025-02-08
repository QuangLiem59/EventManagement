<?php

use App\Containers\AppSection\Authorization\UI\API\Controllers\CreatePermissionController;
use Illuminate\Support\Facades\Route;

Route::post('permissions', [CreatePermissionController::class, 'createPermission'])
    ->middleware(['auth:api']);

