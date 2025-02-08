<?php

namespace App\Containers\AppSection\File\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\File\UI\API\Requests\UploadFileRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Exception;
use Illuminate\Support\Facades\Storage;

class UploadFileAction extends ParentAction
{
    /**
     * @param UploadFileRequest $request
     * @return array
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(UploadFileRequest $request): array
    {
        $type = $request->get('type', 'file');
        $urls = [];
        if ($type == 'file') {
            $files = $request->file('files');

            foreach ($files as $file) {
                $path = $file->store('public');
                $url = Storage::url($path);
                $urls[] = str_replace('public/', '', $url);
            }
        } else {
            try {
                $data = $request->data;
                list($extension, $content) = explode(';', $data);
                $tmpExtension = explode('/', $extension);
                $fileName = 'img_' . date('YmdHis') . '.' . $tmpExtension[1];
                $content = explode(',', $content)[1];
                $path = 'public/' . $fileName;
                Storage::put($path, base64_decode($content));
                $url = Storage::url($path);
                $urls[] = str_replace('public/', '', $url);
            } catch (Exception) {
                throw new Exception(trans('validation.base64_image', ['attribute' => 'data']));
            }
        }

        return $urls;
    }
}
