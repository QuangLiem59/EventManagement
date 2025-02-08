<?php

namespace App\Containers\WrittenSection\Documentation\UI\WEB\Requests;

use App\Containers\WrittenSection\Documentation\Traits\HasDocAccessTrait;
use App\Ship\Parents\Requests\Request as ParentRequest;

class GetPrivateDocumentationRequest extends ParentRequest
{
    use HasDocAccessTrait;

    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => ['access-private-docs'],
        'roles' => [],
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [
        
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [
        
    ];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
            'hasDocAccess'
        ]);
    }
}
