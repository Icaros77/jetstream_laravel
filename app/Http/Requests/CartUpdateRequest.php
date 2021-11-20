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
        // dd($req->all());
        return [
            'product_data' => ['required', 'array'],
        ];
    }

    public function messages()
    {
        return [
            'product_data.required' => 'Product is required',
            'product_data.array' => 'Product must be array'
        ];
    }
}
