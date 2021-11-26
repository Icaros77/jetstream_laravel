<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRemoveItemRequest extends FormRequest
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
            "id" => ["required", "numeric", "integer", "exists:products,id"],
            "product_number" => ["required", "string"]
        ];
    }

    public function messages()
    {
        return [
            "id.required" => "ID required",
            "id.numeric" => "ID must be a number",
            "id.integer" => "ID must be a integer",
            "id.exists" => "ID doesn't exists",
            "product_number.required" => "Product number required",
            "product_number.string" => "Product number must be a string"
        ];
    }
}
