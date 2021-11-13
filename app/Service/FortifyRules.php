<?php

namespace App\Service;

trait FortifyRules
{

    /**
     * gives back the rules for Current setted username in fortify
     * @return Array
     */
    public function rulesFortify(string $action = 'login'): array
    {
        if ($action === 'login') {
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

}
