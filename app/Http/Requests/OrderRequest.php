<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
            'is_insured' => 'required|boolean',
            'prescription' => 'required',
            'prescription.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'delivering_address_id' => [
                'required',
                Rule::in(auth()->user()->client->addresses()->pluck('id')->toArray()) // to make sure that the address belongs to this client
            ]
        ];
    }
}
