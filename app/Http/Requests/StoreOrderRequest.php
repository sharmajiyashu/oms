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
            'customer_name'  => 'required',
            'mobile'  => 'required',
            'email'  => 'required',
            'product' => 'required',
            'quantity'  => 'required',
            'card_number'  => 'required',
            'card_exp'  => 'required',
            'amount'  => 'required',
            'card_cvv'  => 'required',
            'quantity'  => 'required',
            'customer_type' => 'required',
            'sh_zip_code' => 'required',
            'sh_state' => 'required',
            'sh_city' => 'required',
            'sh_address' => 'required',
            'bl_address' => 'required',
            'bl_city' => 'required',
            'bl_state' => 'required',
            'bl_zip_code' => 'required',
        ];
    }
}
