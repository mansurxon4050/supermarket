<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductItemResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use JsonException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function star_add(Request $request)
    {
        // auth()->user();
        $productStar=Product::find($request->id)->get('star');
        $productStar += $request->star;
        $productStar->save();
        return $productStar;
    }
    public function favorite_add(Request $request)
    {
        // auth()->user();
        $user=User::find($request->userId);
        if($user->favorite_product==null){
            $user->favorite_product=[];
        }

        $old_array=$user->favorite_product;
        $old_array[]=$request->productId;
        $user->favorite_product=$old_array;
        $user->save();
        return $user;
    }
    public function favorite_index(Request $request)
    {
        // auth()->user();
        $user=User::find($request->id);
        if($user->favorite_product==null){
            $user->favorite_product=[];
        }

        $favorite=$user->favorite_product;

        foreach ($favorite as $item) {

            $products=Product::Where('id', $item)->paginate();

            return  ProductItemResource::collection($products);
        }

        //return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
