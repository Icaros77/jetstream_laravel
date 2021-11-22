<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    // use FortifyRules;


    protected $redirectRoute = "login";
    protected $errorBag = 'loginErrors';

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
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string'
        ];
    }

    public function messages()
    {
        return
            [
                'email.required' => 'Email is required',
                'email.email' => 'Email format must be a regular email',
                'email.string' => 'Email must be a string',
                'email.exists' => 'No user found',
                'password.required' => 'Password is required',
                'password.string' => 'Password must be a string',
            ];
    }
}
