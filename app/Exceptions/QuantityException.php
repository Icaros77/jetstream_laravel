<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class QuantityException extends Exception
{
    protected $products;

    public function __construct($message, $products)
    {
        $products?->each(function($product) use(&$message) {
            $vendor = $product->vendor_id;
            $id = $product->id;
            $message .= "product id $id, vendor id $vendor,\n\r";
        });
        $message = preg_match("/,\n\r$/", "", $message);

        parent::__construct($message);
        $this->products = $products;
    }

    protected function printMessage() :string
    {
        $products = $this->products;

        $names = $products->pluck("name")->implode(", ");
        return "Not enough items in stock for: " . $names;

    }

    public function render()
    {
        $message = $this->printMessage();
        return redirect()->back()->with(['error' => $message]);
    }
}
