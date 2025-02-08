<?php

/**
 * @apiGroup           File
 * @apiName            UploadFile
 *
 * @api                {POST} /v1/files/upload Upload File
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 * 
 * @apiBody            {Enum="file","base64"} [type=file]
 * @apiBody            {File[]} [files] Bắt buộc nếu type = `file`. Max: 5MB. Mimes: jpg, jpeg, png, gif, webp, txt, doc, docx, xls, xlsx, pdf, zip, rar, psd
 * @apiBody            {String} [data] Bắt buộc nếu type = `base64`
 *
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
  "data": {
    "urls": [
      // ...
    ]
  }
}
 */

use App\Containers\AppSection\File\UI\API\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;

Route::post('files/upload', [UploadFileController::class, 'uploadFile'])
    ->middleware(['auth:api']);

