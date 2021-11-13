<?php

namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Fortify;

class FortifyRequest
{
    protected $name;
    protected $req;
    protected $route;

    public function __construct(Request $req)
    {
        $this->name = Fortify::username();
        $this->req = $req;
        $this->route = $req->route()->getName();
    }

    /**
     * gives back the rules for Current setted username in fortify
     * @return Array
     */
    public function rules(): array
    {
        if ($this->route === 'login') {
            $rules = [
                'email' => ['required', 'string', 'email', "exists:users,email"],
                'password' => ['required', 'string']
            ];
        } else {
            $rules = [
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', "unique:users,email"],
                'password' => ['required', 'string'],
                'password_confirmation' => ['required', 'string', 'same:password']
            ];
        }
        return $rules;
    }

    /**
     * generates error messages when validations fails
     * @return Array
     */

    public function messages(): array
    {
        $name = $this->name;
        $messages = [
            $name . '.required' =>     ucfirst($name) . ' is required',
            $name . '.string'   =>     ucfirst($name) . 'must be a string',
            $name . '.unique'   =>     ucfirst($name) . " already exists",
            $name . 'email'     =>     ucfirst($name) . " must be a valid email address", 
            $name . 'exists'     =>    "No user has been found" 
        ];
        return $messages;
    }

    /**
     * validates the input
     */

     public function validates()
     {
         $validate = Validator::make(
             $this->req->all(),
             $this->rules(),
             $this->messages()
         );


         return $validate;
     }
}
