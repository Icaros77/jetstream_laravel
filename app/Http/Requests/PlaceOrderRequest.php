<?php

namespace App\Http\Requests;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
     *cd
     * @return array
     */
    public function rules()
    {
        $default_rules = [
            "payment_method" => ["required", "numeric", "exists:payment_methods,id"],
            "payment_info" => ["required", "numeric"],
            "code" => ["required", "numeric"],
        ];

        $session_rules = [
            "client_name" => ["required", "string"],
            "client_email" => ["required", "string", "email"],
            "shipment_address" => ["required", "string"],
            "shipment_postal_code" => ["required", "string"],
            "shipment_city" => ["required", "string"],
            "shipment_country" => ["required", "string"],
        ];

        $logged_in_rules = ["info_id" => ["required", "numeric", "exists:infos,id"]];

        return array_merge(
            $default_rules,
            Auth::check() ? $logged_in_rules : $session_rules
        );
    }

    public function messages()
    {
        return [
            "payment_method.required" => "Please select a payment method",
            "payment_method.exists" => "Payment method doesn't exist",

            "payment_info.required" => "Please insert a payment info",

            "client_name.required" => "Please insert a name",
            "client_name.string" => "The name must be a string",
            "client_email.required" => "Please insert a Email",
            "client_email.string" => "The Email must be a string",
            "client_email.email" => "Must be a valid Email address",

            "shipment_addresss.required" => "Please insert an address for shipment",
            "shipment_addresss.string" => "The address must be a string",

            "shipment_postal_code.required" => "Please insert a Postal Code for the shipment",
            "shipment_postal_code.string" => "The Postal Code must be a string",

            "shipment_city.required" => "Please insert a City for the shipment",
            "shipment_city.string" => "The City must be a string",

            "shipment_country.required" => "Please insert a Country for the shipment",
            "shipment_country.string" => "The Country must be a string",
        ];
    }
}
