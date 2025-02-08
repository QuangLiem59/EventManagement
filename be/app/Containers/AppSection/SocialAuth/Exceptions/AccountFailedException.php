<?php

namespace App\Containers\AppSection\SocialAuth\Exceptions;

use Apiato\Core\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class AccountFailedException extends Exception
{
	protected $code = Response::HTTP_CONFLICT;
	protected $message = 'Failed getting User for Social Authentication.';
}
