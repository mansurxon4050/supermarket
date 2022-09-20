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
        $arr_length = count($Allcategory);
        $categories=[];
        foreach ($Allcategory as $i => $iValue) {
            for($j = $i+1; $j<$arr_length; $j++ ){
                if($iValue->category!=$Allcategory[$j]->category){
                    $categories[] = ["category"=> $iValue->category];
                    break;
                }
                }
        }
        return response()->json([
        "success"=>true,
        "data"=>$categories
        ]);

    }


}
