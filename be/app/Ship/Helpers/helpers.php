<?php

function md_storage_url($path)
{
    if (!$path) {
        return $path;
    }

    if (!str_starts_with($path, 'storage/')) {
        $path = 'storage/' . $path;
    }

    return config('app.url') . '/' . $path;
}

function md_storage_path($url)
{
    if (!$url) {
        return $url;
    }

    return str_replace(config('app.url') . '/', '', $url);
}