<?php

namespace App\Containers\WrittenSection\Welcome\UI\API\Controllers;

use App\Containers\WrittenSection\Welcome\Actions\FindMessageForApiRootVisitorAction;
use App\Containers\WrittenSection\Welcome\Actions\FindMessageForApiV1VisitorAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
	public function apiRoot(): JsonResponse
	{
		$message = app(FindMessageForApiRootVisitorAction::class)->run();
		return response()->json($message);
	}

	public function v1ApiLandingPage(): JsonResponse
	{
		$message = app(FindMessageForApiV1VisitorAction::class)->run();
		return response()->json($message);
	}
}
