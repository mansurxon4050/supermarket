<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductItemResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(){

        $product = Product::paginate(5);
        return ProductItemResource::collection($product);
    }
    public function item(Request $request){
        return response()->json([
            'success' => true,
            'data' => ProductItemResource::collection(
                Product::where(['id' => $request->id])->get())
        ]);
    }
    public function category(){
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
        return response()->json([
            'success' => true,
            'data' => $Newcat
        ]);

    }
}
