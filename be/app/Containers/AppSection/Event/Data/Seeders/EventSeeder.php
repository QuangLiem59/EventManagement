<?php

namespace App\Containers\AppSection\Event\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreatePermissionsTask;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class EventSeeder extends ParentSeeder
{
    public function run()
    {
        $list = [];
        $list[] = ['manage-events', '', 'Manage Event', 'api'];

        app(CreatePermissionsTask::class)->run($list, addRoleAdmin: true);
    }
}
