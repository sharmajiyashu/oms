<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
        ];
    }
}
