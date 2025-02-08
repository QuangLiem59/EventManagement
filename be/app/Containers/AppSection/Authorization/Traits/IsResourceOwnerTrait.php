<?php

namespace App\Containers\AppSection\Authorization\Traits;

trait IsResourceOwnerTrait
{
    private function allowAll()
    {
        return $this->user()->hasAnyRole(config('apiato.requests.allow-roles-to-access-all-routes'));
    }
    
    public function isResourceOwner(): bool
    {
        if ($this->allowAll()) {
            return true;
        }

        return hash_equals((string)$this->user()->getKey(), (string)$this->id);
    }

    public function isSelf()
    {
        if ($this->allowAll()) {
            return true;
        }

        $user = $this->user();

        return $user->id == $this->user_id;
    }
}
