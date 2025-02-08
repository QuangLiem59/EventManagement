<?php

namespace App\Containers\WrittenSection\Welcome\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
	public function sayWelcome()
	{
		return view('writtenSection@welcome::welcome-page');
	}
}
