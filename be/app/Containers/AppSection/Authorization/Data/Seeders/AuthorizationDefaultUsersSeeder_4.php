<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use Throwable;

class AuthorizationDefaultUsersSeeder_4 extends ParentSeeder
{
    /**
     * @throws CreateResourceFailedException
     * @throws Throwable
     */
    public function run(): void
    {
        $this->createSuperAdmin();
    }

    /**
     * @throws CreateResourceFailedException
     * @throws Throwable
     */
    private function createSuperAdmin(): void
    {
        $userData = [
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ];

        app(CreateAdminAction::class)->run($userData);
    }
}
