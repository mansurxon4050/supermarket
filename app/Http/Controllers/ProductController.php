<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductItemResource;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function create_product(Request $request){

        $request->validate([
            'avatar' => 'required|image',
            'name'=> 'required',
            'star'=> 'required',
            'info'=> 'required',
            'description'=> 'required',
            'category'=> 'required',
            'type'=> 'required',
            'price'=> 'required',
            'discount'=> 'required',
            'discount_price'=> 'required',
            'count'=> 'required'
        ]);

        $data=$request->all();
        $filename = $request->file('product');
        $imagename = "products/" . $filename->getClientOriginalName();
        $filename->move(public_path() . '/storage/products/', $imagename);
        $data['product'] = $imagename;
        Product::create($data);

        return response()->json(['success' => true]);
    }


    public function index_all(){
        $products=Product::orderBy('id','DESC')->paginate();
        return ProductItemResource::collection($products);
    }

    public function sold(Request $request){

    return $request;

    }

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
    public function discount(){

        $products=Product::Where('discount','>','0')->paginate();

        return ProductItemResource::collection($products);

    }
    public function star_add(Request $request)
    {
        $product=Product::findOrFail($request->id);
        $count=$product->star+$request->star;
        $product->star= (string)$count;
        $product->save();
        return response()->json(['success' => true, 'message' =>" success"]);
    }
}















/* $productStar=$product->star;
        $productStar+=$request->star;
        $productStar->save();*/

/*return response()->json(['success' => true, 'message' =>" success"],200);*/
