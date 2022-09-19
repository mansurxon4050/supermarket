<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(){

        $product = Product::paginate(5);
        return ProductResource::collection($product);
    }
    public function item(Request $request){

        $product = Product::where('id',$request->id)->get();
        return response($product);
    }


}
