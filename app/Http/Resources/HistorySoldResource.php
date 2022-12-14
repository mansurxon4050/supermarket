<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistorySoldResource extends JsonResource
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
            'user_id' => $this->user_id,
            'payment_type' => $this->payment_type,
            'total_price' => $this->total_price,
            'address' => $this->address,
            'muljal' => $this->muljal,
            'address_phone_number' => $this->address_phone_number,
            'long' => $this->long,
            'lat' => $this->lat,
            'name' => $this->name,
            'data' => $this->data,
            'created_at' => $this->created_at,
        ];
    }
}
