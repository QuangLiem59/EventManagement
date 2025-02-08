<?php

/**
 * @apiGroup           RolePermission
 * @apiName            CreateRole
 * @api                {POST} /v1/roles Create Role
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiBody            {String} name Unique Name. Regex: /^[a-z0-9-]{2,100}$/
 * @apiBody            {String} display_name
 * @apiBody            {String} description
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\CreateRoleController;
use Illuminate\Support\Facades\Route;

Route::post('roles', [CreateRoleController::class, 'createRole'])
    ->middleware(['auth:api']);
