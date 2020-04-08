<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class DoctorRequest extends FormRequest
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
            'name'=>'required|min:3|regex:/^[\pL\s\-]+$/u',
            'email' => [
                'required',
                'regex:/(.+)@(.+)\.(.+)/i',
                //$this->user ? Rule::unique('users')->ignore($this->user->id) : 'unique:users',
                $this->user ? Rule::unique('users')->ignore($this->doctor->id) : 'unique:users',
            ],
            'national_id' => [
                'required',
                'min:14',
                'max:14',
                $this->user ? Rule::unique('users')->ignore($this->user->id) : 'unique:users',
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => 'sometimes|image|mimes:jpeg,jpg|max:2048',
        ];
    }
    public function messages()
{
    return [
            'national_id.min'=>"national id must be 14 characters",
            'national_id.max'=>"national id must be 14 characters"
        
            
    ];
}
}

