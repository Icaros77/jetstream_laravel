<?php

namespace App\Service;

use App\Http\Requests\StorePaymentInfoRequest;
use App\Models\PaymentInfo;
use App\Models\PaymentMethod;
use App\Models\User;

class PaymentService
{

    /**
     * Register a new payment method
     * @param StorePaymentInfoRequest $method
     * @return void
     */

    public function addPaymentMethod(StorePaymentInfoRequest $req): void
    {
        $method = $req->validated();
        PaymentMethod::create($method);
    }

    /**
     * Add payment method to the user
     * @param User $user
     * @param array $infos
     * @return void
     */
    public function addPaymentMethodFor(User $user, array $infos): void
    {
        PaymentInfo::create(
            array_merge(
                $infos,
                [
                    "default" => 1,

                    "client_id" => $user->id
                ]
            )
        );
    }
}
