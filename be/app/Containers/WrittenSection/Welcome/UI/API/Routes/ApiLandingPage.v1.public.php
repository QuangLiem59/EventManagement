<?php

use App\Containers\WrittenSection\Welcome\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'v1ApiLandingPage'])
    ->name('v1_api_landing_route');
