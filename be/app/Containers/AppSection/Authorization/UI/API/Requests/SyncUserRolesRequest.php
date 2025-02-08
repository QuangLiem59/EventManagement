<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;

class SyncUserRolesRequest extends ParentRequest
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [
        'user_id',
        'users_ids.*',
        'roles_ids.*',
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [

    ];

    public function rules(): array
    {
        return [
            'user_id' => [
                Rule::requiredIf(fn() => !$this->has('users_ids')),
                Rule::exists(User::getTableName(), 'id'),
            ],
            'users_ids' => [
                Rule::requiredIf(fn() => !$this->has('user_id')),
                'array',
            ],
            'users_ids.*' => [
                'distinct',
                Rule::exists(User::getTableName(), 'id'),
            ],
            'roles_ids' => 'required|array',
            'roles_ids.*' => [
                'distinct',
                Rule::exists(Role::getTableName(), 'id'),
            ],
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
