<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Pharmacy;

class StorePharmacyRequest extends FormRequest
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
        if(request()->ID) 
        {$user = Pharmacy::find(request()->ID)->user;
        $pharmacy=Pharmacy::find(request()->ID);
        }else{
            $pharmacy=null;
        }
        return [
        'name'=>['required','min:3',$pharmacy ? Rule::unique('users')->ignore($user->id) : 'unique:users'],
        'email'=>['required',$pharmacy ? Rule::unique('users')->ignore($user->id) : 'unique:users'],
        'national_id'=>['required','min:10','max:10',$pharmacy ? Rule::unique('users')->ignore($user->id) : 'unique:users'],
        'area_id'=>'required',
        'role_id'=>'required',
        ];
    }
}
