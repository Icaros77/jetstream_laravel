<?php

namespace App\Exceptions;

use Exception;

class SQLInjectionException extends Exception
{
    public function report()
    {
    }

    public function render()
    {
        return redirect()->back()
            ->with(['error' => 'An error is occurred']);
    }
}
