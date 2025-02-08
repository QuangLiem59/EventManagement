<?php

namespace App\Containers\AppSection\User\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreatePermissionsTask;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class UserPermissionsSeeder_1 extends ParentSeeder
{
    public function run(): void
    {
        $list = [];
        $list[] = ['manage-users', '', 'Manage User', 'api'];

        app(CreatePermissionsTask::class)->run($list);
    }
}
