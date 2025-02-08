<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\SubAction;
use App\Containers\AppSection\SocialAuth\Abstracts\SocialAuthProvider;
use App\Containers\AppSection\SocialAuth\Exceptions\UnsupportedSocialAuthProviderException;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;

class GetSocialAuthProviderInstanceSubAction extends SubAction
{
    /**
     * @throws UnsupportedSocialAuthProviderException
     */
    public function run(ApiAuthenticateRequest $request): SocialAuthProvider
    {
        $providerInstance = $this->getProviderInstance($request);

        if (is_null($providerInstance)) {
            throw new UnsupportedSocialAuthProviderException("The Social Auth Provider $request->provider is unsupported.");
        }

        return $providerInstance;
    }

    private function getProviderInstance(ApiAuthenticateRequest $request)
    {
        foreach (config('appSection-socialAuth.providers') as $providerName => $providerClass) {
            if ($request->provider == $providerName) {
                return app($providerClass, [$request]);
            }
        }
    }
}
