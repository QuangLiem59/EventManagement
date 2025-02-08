<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreatePermissionsTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class AuthorizationPermissionsSeeder_1 extends ParentSeeder
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(): void
    {
        $list = [];
        $list[] = ['access-private-docs', '', 'Xem tài liệu API', 'web'];
        $list[] = ['manage-roles', 'Xem danh sách, thêm, xóa vai trò. Gán quyền cho vai trò', 'Quản lý phân quyền', 'api'];
        $list[] = ['manage-permissions', 'Xem danh sách quyền, thêm quyền/xóa quyền cho tài khoản', 'Quản lý quyền', 'api'];
        $list[] = ['manage-admins-access', 'Thêm hoặc cập nhật vai trò cho tài khoản', 'Phân quyền cho user', 'api'];

        app(CreatePermissionsTask::class)->run($list);
    }
}
