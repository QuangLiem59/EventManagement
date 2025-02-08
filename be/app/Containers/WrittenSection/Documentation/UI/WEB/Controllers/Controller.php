<?php

namespace App\Containers\WrittenSection\Documentation\UI\WEB\Controllers;

use App\Containers\WrittenSection\Documentation\UI\WEB\Requests\GetPrivateDocumentationRequest;
use App\Containers\WrittenSection\Documentation\UI\WEB\Requests\GetPublicDocumentationRequest;
use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
    public function showPrivateDocs(GetPrivateDocumentationRequest $request)
    {
        return view('writtenSection@documentation::documentation.private.index');
    }

    public function showPublicDocs(GetPublicDocumentationRequest $request)
    {
        return view('writtenSection@documentation::documentation.public.index');
    }
}
