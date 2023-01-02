<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistorySoldResource;
use App\Http\Resources\ProductItemResource;
use App\Http\Resources\UserResource;
use App\Models\HistorySold;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use JsonException;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */

    public function userMonthPrice(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $price=$request->month_price;
        $users=User::where('month_price','>', $price)->orderBy('month_price','DESC')->paginate();

        return UserResource::collection($users);
    }
     public function user_search(Request $request)
    {
        $s=$request['search'];
        $users=User::where('name','like',"%$s%")
            ->orWhere('phone_number', 'like',"%$s%")
            ->orWhere('id', 'like',"%$s%")
            ->orWhere('roleId', 'like',"%$s%")->orderBy('id','DESC')->paginate();

        return UserResource::collection($users);
    }
 public function index()
    {
        $users=User::orderBy('id','DESC')->paginate();
        return UserResource::collection($users);
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
        if($data==null || $data==isEmpty()){
        return  response()->json(['success'=>false,'data'=>[]]);
        }
        $count=count($data);
        for($i=0;$i<$count;$i++){
            if($data[$i]!=null || $data[$i]!=isEmpty()){
                $products=Product::find($data[$i]);
            }
        }
        return response()->json(['success'=>true,'data'=>ProductItemResource::collection($products)]);


    }
     public function favorite_delete(Request $request)
    {
        // auth()->user();
        $user=User::find($request->id);
        $newArray=[];

        $user->favorite_product=$newArray;
        $user->save();
        return $user;


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_role(Request $request)
    {
        $user=User::findOrFail($request->id)->update(['roleId'=>$request->roleId]);
        return response()->json([
            'success' => true,
            'message' => 'roleId updated successfully',
        ]);
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
