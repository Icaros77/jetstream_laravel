<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartUpdateRequest extends FormRequest
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
            'products' => ['required', 'array'],
            'total_amount_cart' => ['required', 'numeric','integer', 'min:0']
        ];
    }

    public function messages()
    {
        return [
            'cart.required' => 'Cart is required',
            'cart.array' => 'Cart required products',
            'total_amount_cart.required' => 'Total amount is required',
            'total_amount_cart.number' => 'Total amount must be a number', 
            'total_amount_cart.min' => 'Total amount cannot be negative', 
            'total_amount_cart.integer' => 'Total amount must be a integer', 
        ];
    }
}
