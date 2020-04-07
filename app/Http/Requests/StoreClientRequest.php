<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
            'national_id' => 'required|unique:users|size:14',
            'gender'=> 'required|in:male,female',
            'image' => 'required|image|mimes:jpeg,jpg',
            'birthdate' => 'required|date_format:Y-m-d',
            'mobile' => 'required|size:11',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
    */
    // public function messages()
    // {
    //     return [
    //         'title.required' => 'Title of post is required',
    //         'title.unique' => 'Title of post must be unique',
    //         'description.required'  => 'Description of post is required',
    //         'image.image' => 'file is not an image',
    //         'image.mimes' => 'Image extension is not png or jpg ',
    //         'title.min' => 'the length of title must be greater than 3',
    //         'description.min'  => 'the length of description must be greater than 10',
    //         'user_id.exists' =>'user doesn\'t exist'
    //     ];
    // }
}
