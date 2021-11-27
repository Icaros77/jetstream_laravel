<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
    public function rules(Request $req)
    {
        return [
            'id' => ["required", "numeric", "integer"],
            'name' => ["required", "string"],
            'product_number' => ["required", "string"],
            'demand' => ["required", "numeric", "integer"],
            'quantity' => ["required", "numeric", "integer"],

        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'ID required',
            'id.numeric' => 'ID must be a number',
            'id.integer' => 'ID must be an integer',

            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',

            'product_number.required' => 'Product number is required',
            'product_number.string' => 'Product number must be a string',

            'demand.required' => 'Demand is required',
            'demand.numeric' => 'Demand must be a number',
            'demand.integer' => 'Demand must be an integer',
            
            'quantity.required' => 'Demand is required',
            'quantity.numeric' => 'Demand must be a number',
            'quantity.integer' => 'Demand must be an integer'
        ];
    }
}
