<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentInfoRequest extends FormRequest
{

    protected $redirectRoute = "orders.create";
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
            "payment_method_id" => ["required", "exists:payment_methods,id"],
            "info" => ["present", "nullable", "string"],
        ];
    }

    public function messages()
    {
        return [
            "payment_method_id.required" => "Method of payment is required",
            "payment_method_id.exists" => "Payment method doesn't exist in the records",

            "info.present" => "Info method must be present, can be empty or null",
            "info.string" => "If Info is present and not null, must be a string"
        ];
    }
}
