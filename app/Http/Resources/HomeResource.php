<?php

namespace App\Http\Resources;

use App\Models\Banner;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    $banners=Banner::get('image');
    $bannerId=Banner::get('id');
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>$this->image,
            'price'=>$this->price,
            'star'=>$this->star,
            'info'=>$this->info,
            'banners'=>$banners,
            'bannerId'=>$bannerId,
            ];
    }
}
