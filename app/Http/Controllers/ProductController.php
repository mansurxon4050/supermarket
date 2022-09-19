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

        $product = Product::where('id',$request->id)->get();

       // return response()->json($product);
        return response()->json([
            'success' => true,
            'data' => ProductItemResource::collection(
                Product::where(['id' => $request->id])->get())
        ]);

        // return response(ProductItemResource::collection($product));
    }


}
