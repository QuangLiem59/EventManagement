<?php

namespace App\Containers\AppSection\File\Tasks;

use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\Storage;

class DeleteFileTask extends ParentTask
{
    public function run($url = null)
    {
        if (!$url) {
            return false;
        }
        
        $path = md_storage_path($url);
        $path = str_replace('storage/', '', $path);

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
