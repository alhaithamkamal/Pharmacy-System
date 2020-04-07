<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|string|email|max:255|unique:users,email,'. $this->user_id,
            'national_id' => 'required|size:14|unique:users,national_id,'. $this->user_id,
            'gender'=> 'required|in:male,female',
            'image' => 'image|mimes:jpeg,jpg',
            'birthdate' => 'required|date_format:Y-m-d',
            'mobile' => 'required|size:11|unique:clients,mobile,'. $this->client,
        ];
    }
}
