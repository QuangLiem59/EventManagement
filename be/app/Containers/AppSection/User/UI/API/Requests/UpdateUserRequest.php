<?php

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Containers\AppSection\Authorization\Traits\IsResourceOwnerTrait;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends ParentRequest
{
    use IsResourceOwnerTrait;

    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => 'manage-users',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [
        'id',
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [
        'id',
    ];

    public function rules(): array
    {
        return [
            'name' => 'min:2|max:200',
            'username' => [
                'min:4',
                'max:50',
                Rule::unique(User::getTableName(), 'username')->ignore($this->id),
            ],
            'email' => [
                'nullable',
                'email',
                'max:200',
                Rule::unique(User::getTableName(), 'email')->ignore($this->id),
            ],
            'phone' => [
                'nullable',
                'max:20',
                Rule::unique(User::getTableName(), 'phone')->ignore($this->id),
            ],
            'password' => User::getPasswordValidationRules(),
            'gender' => 'in:male,female,unspecified',
            'birthday' => 'nullable|date_format:Y-m-d',
            'avatar' => 'nullable|url|max:250',
            'status' => 'in:enable,disable',
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess|isResourceOwner',
        ]);
    }
}
