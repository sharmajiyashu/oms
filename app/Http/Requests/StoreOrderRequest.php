<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
     * @return array<string, mixed>
     */


    public function rules()
    {
        return [
            'customer_type'  => 'required',
            'company'  => 'required',
            'delivery_method'  => 'required',
            'customer_name' => 'required',
            'sh_address'  => 'required',
            'product'  => 'required',
            'quantity'  => 'required',
            'amount'  => 'required',
            'mobile'  => 'required',
            'card_number'  => 'required',
            'card_exp' => 'required',
            'bl_address' => 'required',
        ];
    }
}
