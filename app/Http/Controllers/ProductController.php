<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductItemResource;
use App\Http\Resources\SearchResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request){

        $product = Product::where('category',$request->category)->paginate();
        return ProductItemResource::collection($product);
    }
    public function item(Request $request){
        return response()->json([
            'success' => true,
            'data' => ProductItemResource::collection(
                Product::where(['id' => $request->id])->get())
        ]);
    }
    public function search(Request $request){

        $s=$request['search'];
        $products=Product::where('name','like',"%$s%")
            ->orWhere('description', 'like',"%$s%")
            ->orWhere('category', 'like',"%$s%")
            ->orWhere('info', 'like',"%$s%")->paginate();

        return  ProductItemResource::collection($products);

    }
}
