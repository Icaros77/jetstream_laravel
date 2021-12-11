<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiVendorStoreRequest extends FormRequest
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
            "name" => ["required", "string"],
            "identifier" => ["required", "string"],
            "address" => ["required", "string"],
            "postal_code" => ["required", "string"],
            "city" => ["required", "string"],
            "country" => ["required", "string"]
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Please insert a name for your company",
            "name.string" => "The name must be a string",

            "identifier.required" => "Please specify an identifier for your company",
            "identifier.string" => "The identifier must be a string",

            "address.required" => "Specifiy an address",
            "address.string" => "The address must be a string",

            "postal_code.required" => "Specify a postal code for the company",
            "postal_code.string" => "The postal code must be a string",
            
            "city.required" => "Specify a city for the company",
            "city.string" => "The city must be a string",

            "country.required" => "Specify the country for the company",
            "country.string" => "The country must be a string"

        ];
    }
}
