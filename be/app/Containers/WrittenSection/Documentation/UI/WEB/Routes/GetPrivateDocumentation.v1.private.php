<?php

use App\Containers\WrittenSection\Documentation\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

if (config('writtenSection-documentation.protect-private-docs')) {
	Route::get(config('writtenSection-documentation.types.private.url'), [Controller::class, 'showPrivateDocs'])
		->name('private_docs')
		->middleware('auth:web');
} else {
	Route::get(config('writtenSection-documentation.types.private.url'), [Controller::class, 'showPrivateDocs'])
		->name('private_docs');
}
