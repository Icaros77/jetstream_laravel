<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoStoreRequest;
use App\Service\InfoService;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function store(InfoStoreRequest $req, InfoService $service)
    {
        $user = $req->user();
        $shipment_info = $req->validated();
        $service->addShipmentInfoTo($user, $shipment_info);
        return redirect()->route("orders.create");
    }
}
