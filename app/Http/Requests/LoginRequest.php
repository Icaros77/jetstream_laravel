<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laravel\Fortify\Fortify;

class LoginRequest extends FormRequest
{

    protected $name;

    public function __construct()
    {
        $this->name = Fortify::username();
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function fortifyUsernameRules()
    {
        $rules = "required|string";
        return $this->name === 'email' ? $rules . '|email' : $rules;
    }

    public function fortifyUsernameMessage()
    {
        $message = [];
        if($this->name === 'email') {
            $message['email'] = 'Email must be a valid email address';
        }
        return $message;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            $this->name => $this->fortifyUsernameRules(),
            'password' => 'required|string'
        ];
    }

    public function messages()
    {
        return array_merge([
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            $this->name . '.required' => $this->name . ' is required',
            $this->name . '.string' => $this->name . 'must be a string'
        ],
        $this->fortifyUsernameMessage()
    );
    }
}
