<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientAddressRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'area_id' => 'required|exists:areas,id',
            'street_name' => 'required',
            'building_number' => 'required|numeric',
            'floor_number' => 'required|numeric',
            'flat_number' => 'required|numeric'
        ];
    }
}
