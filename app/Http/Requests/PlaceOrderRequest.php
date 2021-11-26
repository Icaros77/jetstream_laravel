<?php

namespace App\Http\Requests;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
{
    protected $redirectRoute = RouteServiceProvider::CART;
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
            "client_name" => ["required", "string"],
            "client_email" => ["required", "string", "email"],
            "shippment_address" => ["required", "string"],
            "shippment_postal_code" => ["required", "string", "regex:/\d+\-?\d+/"],
            "shippment_city" => ["required", "string"],
            "shippment_country" => ["required", "string"],
        ];
    }

    public function messages()
    {
        return [
            "client_name.required" => "Please insert a name",
            "client_name.string" => "The name must be a string",
            "client_email.required" => "Please insert a Email",
            "client_email.string" => "The Email must be a string",
            "client_email.email" => "Must be a valid Email address",
            
            "shippment_addresss.required" => "Please insert an address for shippment",
            "shippment_addresss.string" => "The address must be a string",
            
            "shippment_postal_code.required" => "Please insert a Postal Code for the shippment",
            "shippment_postal_code.string" => "The Postal Code must be a string",
            "shippment_postal_code.numeric" => "The Postal Code must be composed by numbers",
            
            "shippment_city.required" => "Please insert a City for the shippment",
            "shippment_city.string" => "The City must be a string",
            
            "shippment_country.required" => "Please insert a Country for the shippment",
            "shippment_country.string" => "The Country must be a string",
        ];
    }
}
