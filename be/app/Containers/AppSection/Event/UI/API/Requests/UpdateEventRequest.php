<?php

namespace App\Containers\AppSection\Event\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class UpdateEventRequest extends ParentRequest
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
        'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [
        'id',
    ];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:events,id',
            'title' => 'min:1|max:100',
            'content' => 'min:1|max:500',
            'date' => 'date|date_format:Y-m-d|after_or_equal:today',
            'location' => 'min:1|max:200',
            'capacity' => 'integer|min:1|max:100',
        ];
    }
}
