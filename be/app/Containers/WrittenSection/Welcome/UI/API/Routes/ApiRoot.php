<?php

use App\Containers\WrittenSection\Welcome\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'apiRoot'])
    ->name('api_welcome_root_page');
