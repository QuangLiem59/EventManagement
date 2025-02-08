<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Parents\Tasks\Task as ParentTask;

class AttachPermissionsToRoleTask extends ParentTask
{
    /**
     * @param array $permissions
     * @param string|Role $role
     * @param string $guard
     * @return array
     */
    public function run(array $permissions, Role|string $role, string $guard = 'api'): array
    {   
        $pers = [];
        foreach ($permissions as $permission) {
            $pers[] = app(FindPermissionTask::class)->run($permission, $guard);
        }

        if (is_string($role)) {
            $roleModel = config('permission.models.role');
            $role = $roleModel::findByName($role, $guard);
        }

        $role->givePermissionTo($pers);

        return $pers;
    }
}
