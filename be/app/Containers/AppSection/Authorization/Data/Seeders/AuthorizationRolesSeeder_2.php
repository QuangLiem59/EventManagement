<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class AuthorizationRolesSeeder_2 extends ParentSeeder
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(): void
    {
        app(CreateRoleTask::class)->run(config('appSection-authorization.docs_role'), 'Xem tài liệu mô tả tất cả API có trên hệ thống', 'Xem tài liệu API', 'web');
        app(CreateRoleTask::class)->run(config('appSection-authorization.admin_role'), 'Vai trò dành cho Administrator', 'Administrator Role', 'api');
    }
}
