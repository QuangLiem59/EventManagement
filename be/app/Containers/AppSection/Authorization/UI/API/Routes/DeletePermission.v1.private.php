<?php

use App\Containers\AppSection\Authorization\UI\API\Controllers\DeletePermissionController;
use Illuminate\Support\Facades\Route;

Route::delete('permissions/{id}', [DeletePermissionController::class, 'deletePermission'])
    ->middleware(['auth:api']);

