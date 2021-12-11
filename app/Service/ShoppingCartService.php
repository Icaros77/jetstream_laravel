<?php
namespace App\Service;

use App\Http\Requests\CartRemoveItemRequest;
use App\Http\Requests\CartUpdateRequest;
use Illuminate\Http\Request;

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

    /**
     * remove item from cart
     * checks id, alrady checked from
     * CartRemoveItmeRequest $req
     * @param Request $req
     * @return void
     */
    // abstract function removeItem(CartRemoveItemRequest $req):void;
    abstract function removeItem(Request $req, $id):void;
}