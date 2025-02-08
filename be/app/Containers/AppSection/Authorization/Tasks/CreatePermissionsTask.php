<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Ship\Parents\Tasks\Task as ParentTask;

class CreatePermissionsTask extends ParentTask
{
    public function run(array $list, bool $addRoleAdmin = false)
    {
        $createPermissionTask = app(CreatePermissionTask::class);

        $permissions = [
            'web' => [],
            'api' => []
        ];
        foreach ($list as $_arr) {
            $permissions[$_arr[3]][] = $createPermissionTask->run(...$_arr);
        }

        if ($addRoleAdmin) {
            $adminRoleName = config('appSection-authorization.admin_role');
            $roleModel = config('permission.models.role');

            foreach ($permissions as $_guard => $_permissions) {
                if (!empty($_permissions)) {
                    $adminRole = $roleModel::findByName($adminRoleName, $_guard);
                    $adminRole->givePermissionTo($_permissions);
                }
            }
        }
    }
}
