<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductItemResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'star' => $this->star,
            'info' => $this->info,
            'description' => $this->description,
            'category' => $this->category,
            'type' => $this->type,
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_price' => $this->discount_price,
            'count' => $this->count,
        ];
    }
}
