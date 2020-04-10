<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Revenue;
use Illuminate\Validation\Rule;

class StoreRevenueRequest extends FormRequest
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
        {$user = Revenue::find(request()->ID)->user;
        $revenue=Revenue::find(request()->ID);
        }else{
            $revenue=null;
        }
        return [
            'pharmacy_name'=>['required','min:3',$revenue ? Rule::unique('revenues')->ignore($revenue->id) : 'unique:revenues'],
            'total_orders'=>'required',
            'total_revenue'=>'required',
        ];
    }
}
