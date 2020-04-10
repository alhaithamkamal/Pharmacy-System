<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Medicine;
use Illuminate\Validation\Rule;

class StoreMedicineRequest extends FormRequest
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
    {   if(request()->ID) 
        {
        $medicine=Medicine::find(request()->ID);
        }else{
            $medicine=null;
        }
        return [
        'name'=>['required','min:3',$medicine ? Rule::unique('medicines')->ignore($medicine->id) : 'unique:medicines'],
        'quantity'=>'required',
        'type'=>'required|min:3',
        'price'=>'required',
        ];
    }
}
