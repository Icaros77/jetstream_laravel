<?php

namespace Tests;

use App\Models\PaymentMethod;
use App\Models\ShoppingList;
use App\Models\User;
use App\Models\Vendor;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    /**
     * Create the user without cart
     * and without info
     * 
     * @return user
     */

    public function createUser()
    {
        User::factory(1)->create(["email" => 'a@hot.com']);
    }

    /**
     * create user with cart
     * @return user
     */

    public function createUserCart()
    {
        User::factory(1)->addInfo()->addCart()->create(["email" => 'atecom@hotmail.it']);
    }

    public function createUserCartWithProducts()
    {
        User::factory(1)->addInfo()->addCartProducts()->create(["email" => "atecom@hotmail.it"]);
    }

    /**
     * set initial data for product to add in request
     */
    public function setRequestCartData(&$data, $demand, $quantity = 0)
    {
        $data['demand'] = $demand;
        $data['quantity'] = $quantity;
    }

    /**
     * setup vendors (2)
     * with quantity relation
     * gives back 2 vendors
     */
    public function setVendors()
    {
        $vendors = Vendor::factory(2)->addProducts(1, 20)->create();
        $vendors->load([
            'products' => function ($query) {
                $query->with('quantity:id,quantity,product_id')
                    ->select('id', 'product_number', 'name', 'vendor_id', 'price', "image_path");
            },
        ]);
        return $vendors;
    }

    
    /**
     * Get the shippment informations
     */
    public function getInfoShipment(?User $user = null)
    {
        $payment_method = PaymentMethod::first()->method;
        $info_shippment = [
            "client_name" => $user->name ?? "Name",
            "client_email" => $user->email ?? "a@g.com",
            "shipment_address" => $user?->info->first()?->address ?? "via m 34",
            "shipment_postal_code" => $user?->info->first()?->postal_code ?? "29121",
            "shipment_city" => $user?->info->first()?->city ?? "city",
            "shipment_country" => $user?->info->first()?->country ?? "amo",
            "payment_method" => $payment_method
        ];
        return $info_shippment;
    }

}
