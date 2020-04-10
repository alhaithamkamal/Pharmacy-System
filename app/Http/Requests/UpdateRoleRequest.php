<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ];
    }
  
    public function messages()
    {
        return [
            'role_id.exists' => 'role doesn\'t not exist',
            'role_id.required' => 'role is required',
            'permissions.*.exists' => 'permission doesn\'t not exist',
            'permissions.*.required' => 'permission is required',
        ];
    }
}
