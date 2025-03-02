<?php

namespace App\Containers\WrittenSection\Documentation\Traits;

use Apiato\Core\Abstracts\Models\UserModel;
use Illuminate\Support\Facades\Auth;

trait HasDocAccessTrait
{
    /**
     * Check if the authenticated user has proper
     * roles/permissions to access the private docs
     */
    public function hasDocAccess(): bool
    {
        if ($this->docsAreProtected()) {
            $user = Auth::user();

            return $this->userExists($user) && $this->haveAccess($user);
        }

        return true;
    }

    private function docsAreProtected()
    {
        return config('writtenSection-documentation.protect-private-docs');
    }

    private function userExists($user): bool
    {
        return $user !== null;
    }

    private function haveAccess(UserModel $user): bool
    {
        return $this->hasRolesWithAccess($user) || $this->hasPermission($user);
    }

    private function hasRolesWithAccess(UserModel $user): bool
    {
        if (is_callable([$user, 'hasRole'])) {
            return $user->hasRole(config('writtenSection-documentation.access-private-docs-roles'), 'web');
        }

        return true;
    }

    private function hasPermission($user)
    {
        if (is_callable([$user, 'checkPermissionTo'])) {
            return $user->checkPermissionTo(config('writtenSection-documentation.access-private-docs-permission'), 'web');
        }

        return true;
    }
}
