<?php

use App\Containers\WrittenSection\Welcome\UI\WEB\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

function responseNoImage()
{
    $path = public_path('no-image.png');
    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
}

function isImageExtension($path)
{
    $allowedMimeTypes = ['jpeg', 'gif', 'png', 'bmp', 'webp', 'svg', 'bpm', 'ico', 'tiff', 'apng', 'avif', 'pjp', 'pjpeg', 'jfif'];
    $arr = explode('.', $path);
    $ext = Arr::last($arr);

    return in_array($ext, $allowedMimeTypes);
}

Route::get('/', [Controller::class, 'sayWelcome'])->name('web_welcome_say_welcome');

Route::get('/storage/{dir}/{filename}', function ($dir, $filename) {
    if ($dir != 'public') {
        $path = 'public' . '/' . $dir . '/' . $filename;
    } else {
        $path = $dir . '/' . $filename;
    }

    if (!Storage::exists($path)) {
        if (isImageExtension($path)) {
            return responseNoImage();
        }

        abort(404);
    }

    return Storage::response($path);
});

Route::get('/storage/{path}', function ($filename) {
    $path = 'public/' . $filename;

    if (!Storage::exists($path)) {
        if (isImageExtension($path)) {
            return responseNoImage();
        }

        abort(404);
    }

    return Storage::response($path);
});
