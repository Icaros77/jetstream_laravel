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
     * @return Info
     */
    public function addShipmentInfoTo(User $user, array $shipment_info): Info
    {
        $info = Info::create(
            array_merge(
                $shipment_info,
                [
                    "default" => 1,
                    "client_id" => $user->id
                ]
            )
        );
        $this->updatesShipmentInfoDefaultFor($user, $info->id);
        return $info;
    }

    /**
     * Updates the default column for current shipment address
     * @param User $user
     * @param  int $id
     * @return void
     */

    public function updatesShipmentInfoDefaultFor(User $user, int $id): void
    {
        $stmt = "UPDATE infos SET infos.default = IF(id = ?, 1 , 0) WHERE client_id = ?;";
        DB::update($stmt, [$id, $user->id]);
    }
}
