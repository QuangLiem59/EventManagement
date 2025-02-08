<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Classes\LoginCustomAttribute;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshCookieTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class ApiLoginProxyForWebClientAction extends ParentAction
{
    /**
     * @param LoginProxyPasswordGrantRequest $request
     * @return array
     * @throws LoginFailedException
     * @throws IncorrectIdException
     */
    public function run(LoginProxyPasswordGrantRequest $request): array
    {
        $keys = array_keys(config('appSection-authentication.login.attributes'));
        $data = $request->sanitizeInput($keys);

        [$username] = LoginCustomAttribute::extract($data);

        $data['password'] = $request->password;
        $data = $this->enrichSanitizedData($username, $data);

        $responseContent = app(CallOAuthServerTask::class)->run($data, $request->headers->get('accept-language'));
        $refreshCookie = app(MakeRefreshCookieTask::class)->run($responseContent['refresh_token']);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }

    private function enrichSanitizedData(string $username, array $data): array
    {
        $data['username'] = $username;
        $data['client_id'] = config('appSection-authentication.clients.web.id');
        $data['client_secret'] = config('appSection-authentication.clients.web.secret');
        $data['grant_type'] = 'password';
        $data['scope'] = '';

        return $data;
    }
}
