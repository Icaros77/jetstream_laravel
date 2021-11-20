<?php
namespace App\Service;

use App\Http\Requests\CartUpdateRequest;

abstract class ShoppingCartService
{
    /**
     * Updates the current user's cart
     * if product doesn't exist in the DB
     * Throws an ProductInvalidException
     * checks id and product_number
     * @param CartUpdateReqeust $req
     * @return Void
     */
    abstract function updateCart(CartUpdateRequest $req):void;
}