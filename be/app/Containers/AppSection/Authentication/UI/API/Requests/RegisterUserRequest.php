<?php

namespace App\Containers\AppSection\Authentication\UI\API\Requests;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends ParentRequest
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [

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
            'name' => 'required|min:2|max:200',
            'username' => [
                'required',
                'min:4',
                'max:50',
                Rule::unique(User::getTableName(), 'username'),
            ],
            'email' => [
                'required',
                'max:200',
                'email',
                Rule::unique(User::getTableName(), 'email'),
            ],
            'phone' => [
                'max:20',
                Rule::unique(User::getTableName(), 'phone'),
            ],
            'password' => [
                'required',
                User::getPasswordValidationRules(),
            ],
            'gender' => 'in:male,female,unspecified',
            'birthday' => 'date_format:Y-m-d',
            'avatar' => 'nullable|url|max:250',
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
