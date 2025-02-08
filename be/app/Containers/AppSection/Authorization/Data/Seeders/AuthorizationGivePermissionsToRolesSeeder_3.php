<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class AuthorizationGivePermissionsToRolesSeeder_3 extends ParentSeeder
{
    public function run(): void
    {
        // tạo quyền cho vai trò admin
        $adminRoleName = config('appSection-authorization.admin_role');
        $roleModel = config('permission.models.role');
        $allPermissions = app(GetAllPermissionsTask::class)->run(true, 'api');
        $adminRole = $roleModel::findByName($adminRoleName, 'api');
        $adminRole->givePermissionTo($allPermissions);

        // tạo quyền cho vai trò xem tài liệu
        $roleDoc = $roleModel::findByName(config('appSection-authorization.docs_role'), 'web');
        $permission1 = app(FindPermissionTask::class)->run('access-private-docs', 'web');
        $roleDoc->givePermissionTo([$permission1]);
    }
}
