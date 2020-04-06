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
            'name'=>'required|min:3|alpha',
            'email' => [
                'required',
                'regex:/(.+)@(.+)\.(.+)/i',
                $this->doctor ? Rule::unique('doctors')->ignore($this->doctor->national_id) : 'unique:doctors',
            ],
            'national_id' => [
                'required',
                'min:14',
                'max:14',
                $this->doctor ? Rule::unique('doctors')->ignore($this->doctor->national_id) : 'unique:doctors',
            ],
            
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
