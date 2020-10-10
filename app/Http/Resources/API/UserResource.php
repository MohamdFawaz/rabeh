<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
          "id" => $this->id,
          "name" => $this->name,
          "email" => $this->email,
          "phone" => $this->phone,
          "user_code" => $this->user_code ?? "-",
          "is_email_verified" => $this->email_verified_at ? true : false,
          "user_type_id" => $this->user_type_id,
          "share_balance" => $this->share_balance,
          "coin_balance" => $this->coin_balance,
          "cash_balance" => $this->cash_balance,
          "point_balance" => $this->point_balance,
          "referer_id" => $this->referer_id ?? 0,
          "trader_id" => $this->trader_id ?? 0,
          "sub_trader_id" => $this->sub_trader_id ?? 0,
          "token" => $this->remember_token,
        ];
    }
}
