<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "identifier" => $this->identifier,
            "address" => $this->address,
            "postal_code" => $this->postal_code,
            "city" => $this->city,
            "country" => $this->country,
            "products" => ProductCollection::collection($this->products)
        ];
    }
}
