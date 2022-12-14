<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class HistorySoldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     * @throws \JsonException
     */
    public function toArray($request)
    {
    /// data decode
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
            'data' => json_decode($this->data, true, 512, JSON_THROW_ON_ERROR),
            'created_at' => Carbon::createFromFormat('Y-m-d H:m:s', $this->created_at)->locale('uz')->isoFormat('Y-m-d H:m:s' ),
        ];
    }
}
