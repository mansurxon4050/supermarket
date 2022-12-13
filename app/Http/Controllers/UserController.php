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
     * @return \Illuminate\Http\JsonResponse
     */

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
        return response()->json(['success' => true, 'message' =>" success"]);
    }
    public function favorite_index(Request $request)
    {
        // auth()->user();
        $user=User::find($request->id);
        $data=array ($user->favorite_product);
        $count=count($data);

        for($i=0;$i<$count;$i++){
            if($data[$i]!=null){
                $products=Product::find($data[$i])->paginate();
            }
        }

        return ProductItemResource::collection($products);


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
