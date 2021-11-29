<?php

namespace App\Service;

use App\Models\Info;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class InfoService

{
    /**
     * Add a new shipment address to User
     * @param User $user
     * @param array $shipment_info
     * @return void
     */
    public function addShipmentInfoTo(User $user, array $shipment_info): void
    {
        $info = Info::create([
            "address" => $shipment_info['shipment_address'],
            "postal_code" => $shipment_info['shipment_postal_code'],
            "city" => $shipment_info['shipment_city'],
            "country" => $shipment_info['shipment_country'],
            "default" => 1,
            "client_id" => $user->id
        ]);
        $this->updatesShipmentInfoDefaultFor($user, $info->id);
    }

    /**
     * Updates the default column for current shipment address
     * @param User $user
     * @param  int $id
     * @return void
     */

    public function updatesShipmentInfoDefaultFor(User $user, int $id): void
    {
        $client_id = $user->id;
        $stmt = "UPDATE infos SET infos.default = IF(id = ?, 1 , 0) WHERE client_id = ?;";
        DB::update($stmt, [$id, $client_id]);
    }
}
