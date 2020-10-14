<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
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
          'image' => 'https://picsum.photos/800/600', //todo change with dynamic image
          'name' => $this->name,
          'description' => $this->description
        ];
    }
}
