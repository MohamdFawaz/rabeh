<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'logo' => $this->image,
            'owner_name' => $this->owner_name,
            'name' => $this->name,
            'description' => $this->description,
            'currency' => 'Coins'
        ];
    }
}
