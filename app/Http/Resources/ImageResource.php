<?php

namespace App\Http\Resources;

use App\Models\Banner;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
        return [
            'id'=>$this->id,
            'image'=>$this->image,
            'info'=>$this->info,
            'banners'=>$banners,
            ];
    }
}
