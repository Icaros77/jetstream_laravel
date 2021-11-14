<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Service\FortifyRules;

class CreateUserRequest extends FormRequest
{
    protected $redirectRoute = 'dashboard';
    protected $errorBag = 'signUpErrors';
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
            'password_confirmation' => 'required|string|same:password',
        ];
    }

    public function messages()
    {
        return
            [
                'name.required' => 'Name is required',
                'name.string' => 'Name must be a string',
                'email.required' => 'Email is required',
                'email.email' => 'Email format must be a regular email',
                'email.string' => 'Email must be a string',
                'email.unique' => 'Email alrady exists',
                'password.required' => 'Password is required',
                'password.string' => 'Password must be a string',
                'password_confirmation.required' => 'Password is required',
                'password_confirmation.same' => 'Passwords don\'t match',
            ];
    }
}
