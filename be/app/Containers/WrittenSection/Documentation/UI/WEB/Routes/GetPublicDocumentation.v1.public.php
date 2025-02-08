<?php

use App\Containers\WrittenSection\Documentation\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get(config('writtenSection-documentation.types.public.url'), [Controller::class, 'showPublicDocs'])
	->name('public_docs');
