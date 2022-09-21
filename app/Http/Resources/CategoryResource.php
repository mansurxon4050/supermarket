<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) : Array
    {
        $Allcategory = Product::get('category');
        $Newcat[]=["category"=>$Allcategory[0]->category];

        $arr_length = count($Allcategory);
        $newCatLength=count($Newcat);

        for($i=1;$i<$arr_length;$i++){
            for($j=0;$j<$newCatLength;$j++){

                if($Newcat[$j]["category"]!== $Allcategory[$i]->category){
                    $Newcat[]=["category"=>$Allcategory[$i]->category];
                }
            }
        }
        return [
        ];
    }

}
