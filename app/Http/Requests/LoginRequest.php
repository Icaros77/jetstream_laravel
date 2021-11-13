<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Service\FortifyRules;
use Illuminate\Contracts\Validation\Validator;
// use Dotenv\Exception\ValidationException;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    // use FortifyRules;


    protected $redirectRoute = "dashboard";
    protected $errorBag = 'loginErrors';

    // public function __construct()
    // {
    //     $this->name = $this->username();
    //     $this->redirectRoute = route("dashboard");
    // }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     $response =
    //         redirect()->route("dashboard")->withErrors($validator);
    //         // dd('hik');
    //         // dd($validator->errors());
    //     new ValidationException(
    //         $validator,
    //         $response,
    //         $this->errorBag
    //     );
    //     return $response;
    // }

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
