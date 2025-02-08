<?php

namespace App\Ship\Parents\Transformers;

use Apiato\Core\Abstracts\Transformers\Transformer as AbstractTransformer;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Auth;

abstract class Transformer extends AbstractTransformer
{
    /**
     * @param array $adminResponse
     * @param array $clientResponse
     * @return array
     */
    public function ifAdmin(array $adminResponse, array $clientResponse): array
    {
        $user = $this->getAuth();

        if (!is_null($user) && $user->hasAdminRole()) {
            return array_merge($clientResponse, $adminResponse);
        }

        return array_merge($clientResponse, [
            'created_at' => $adminResponse['created_at'],
            'updated_at' => $adminResponse['updated_at']
        ]);
    }

    private function getAuth(): ?User
    {
        return Auth::user();
    }
}
