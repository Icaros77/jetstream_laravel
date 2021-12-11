<?php

namespace Tests;

use App\Models\PaymentInfo;
use App\Models\PaymentMethod;
use App\Models\ShoppingList;
use App\Models\User;
use App\Models\Vendor;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Nette\Utils\Random;

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
        $this->create_random_payment_methods();
        $payment_method = PaymentMethod::first();

        $payment = $this->create_random_payment_info();

        $code = Random::generate(3, '0-9');

        $info = $user?->info->first();

        // create a OrderInfoFactory
        $payment_data = [
            "payment_info" => $payment->info,
            "code" => $code,
            "payment_method" => $payment_method->id,
        ];

        $session_user_shipment_info = [
            "client_name" => $user?->name ?? "Name",
            "client_email" => $user?->email ?? "a@g.com",
            "shipment_address" => $info?->address ?? "via m 34",
            "shipment_postal_code" => $info?->postal_code ?? "29121",
            "shipment_city" => $info?->city ?? "city",
            "shipment_country" => $info?->country ?? "amo"
        ];

        $logged_in_user_shipment_info = [
            "info_id" => $info?->id
        ];

        return array_merge(
            $payment_data,
            is_null($user) ? $session_user_shipment_info : $logged_in_user_shipment_info
        );
    }

    /**
     * Create default payment method CC/DC
     */
    public function create_random_payment_methods()
    {
        PaymentMethod::factory(2)
            ->state(new Sequence(["method" => "CC"], ["method" => "DC"]))
            ->create();
    }

    /**
     * Create random payment infos and code
     */
    public function create_random_payment_info()
    {
        return PaymentInfo::factory()->create();
    }
}
