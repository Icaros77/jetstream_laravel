<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentInfoRequest;
use App\Service\PaymentService;
use Illuminate\Http\Request;

class PaymentInfoController extends Controller
{
    public function store(StorePaymentInfoRequest $req, PaymentService $service)
    {
        $user = $req->user();
        $infos = $req->validated();
        $service->addPaymentMethodFor($user, $infos);
        return redirect()->route("orders.create");
    }
}
