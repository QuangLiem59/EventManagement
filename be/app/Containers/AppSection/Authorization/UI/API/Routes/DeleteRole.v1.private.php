<?php

/**
 * @apiGroup           RolePermission
 * @apiName            DeleteRole
 * @api                {DELETE} /v1/roles/:id Delete Role
 * @apiDescription     Delete Role by ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {Number} id role id
 *
 * @apiUse             GeneralNoContentResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\DeleteRoleController;
use Illuminate\Support\Facades\Route;

Route::delete('roles/{id}', [DeleteRoleController::class, 'deleteRole'])
    ->middleware(['auth:api']);
