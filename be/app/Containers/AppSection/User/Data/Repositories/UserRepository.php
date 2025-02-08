<?php

namespace App\Containers\AppSection\User\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class UserRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'id' => '=',
        'name' => 'like',
        'username' => 'like',
        'phone' => 'like',
        'email' => 'like',
        'address' => 'like',
        'status' => '=',
    ];

    public function model(): string
    {
        return config('auth.providers.users.model');
    }
}
