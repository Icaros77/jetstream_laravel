<?php

namespace App\Exceptions;

use Exception;

class ProductInvalidException extends Exception
{
    public function context() {
        return ['product_number' => $this->product_number];
    }

    public function render() {
        return redirect()->back()->with([
            'error' => 'An error occurred. A product is not valid'
        ]);
    }
}
