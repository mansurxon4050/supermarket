<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistorySoldResource;
use App\Http\Resources\HomeResource;
use App\Models\HistorySold;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use JsonException;

class HistorySoldController extends Controller
{
    public function order_accept(Request $request): JsonResponse
    {

        $history=HistorySold::find($request->id);
        if($request->make!=null){
            $history->make=$request->make;
            $history->save();
            return response()->json(['success' => true, 'message' =>" success"]);
        }

        if($request->ready!=null && $history->make!=null && $history->ready==null){
            $history->ready=$request->ready;
            $history->save();
            return response()->json(['success' => true, 'message' =>" success"]);
        }

        if($request->driver!=null && $history->ready!=null && $history->driver==null){
            $history->driver=$request->driver;
            $history->save();
            return response()->json(['success' => true, 'message' =>" success"]);
        }

        return response()->json(['success' => false, 'message' =>"Bad"],500);

    }

    public function history_index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $id=$request->userId;
        $historys=HistorySold::where('user_id',$id)->orderBy('id','DESC')->paginate();
            return HistorySoldResource::collection($historys);
    }
    public function historyAll(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $histories=HistorySold::orderBy('id','DESC')->paginate();
       // $histories=$histories->sortByDesc('id');
        return HistorySoldResource::collection($histories);
    }

    public function history_accepted(Request $request)
    {
        $historys=HistorySold::find($request->id);
        $historys->accepted_time=$request->accepted_time;
        $historys->save();
        return response()->json(['success' => true, 'message' =>" success"]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     * @throws JsonException
     */
    public function create(Request $request)
    {
        $history=HistorySold::create([
            'user_id'=>$request->user_id,
            'payment_type'=>$request->payment_type,
            'total_price'=>$request->total_price,
            'address'=>$request->address,
            'muljal'=>$request->muljal,
            'address_phone_number'=>$request->address_phone_number,
            'long'=>$request->long,
            'name'=>$request->name,
            'order_time'=>$request->order_time,
            'accepted_time'=>$request->accepted_time,
            'data'=> json_encode($request->data, JSON_THROW_ON_ERROR),
        ]);
        $count=0;
        $user=User::findOrFail($request->user_id);
        if($user->month_price==null){
            $user->month_price=(string)$count;
            $user->save();
        }
        $count=$user->month_price+$request->total_price;
        $user->month_price= (string)$count;
        $user->save();

        $history->save();
        return response()->json(['success' => true, 'message' =>" success"]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws JsonException
     */
    public function history_delete(Request $request)
    {
        $historys=HistorySold::where('user_id',$request->id)->update(["delete"=>1]);

        return response()->json(['success' => true, 'data' =>$historys]);
    }

      public function today_cash(Request $request): JsonResponse
      {

        if($request->day!='' && $request->month!=''){
            $history_day = HistorySold::whereDay('created_at', $request->day)->where('accepted_time','!=','null')->sum('total_price');
            $history_month = HistorySold::whereMonth('created_at', $request->month)->where('accepted_time','!=','null')->sum('total_price');
             return response()->json(['success' => true, 'day' => $history_day,'month'=>$history_month ]);
        }
             return response()->json(['success' => false, 'data' => 'Bad error']);
        }

          public function delete_historyDay(): JsonResponse
      {

          HistorySold::where( 'created_at', '<', Carbon::now()->subDays(31))->delete();

           User::where( 'month_price', '!=', '')->update(['month_price'=>'0']);

             return response()->json(['success' => false, 'data' => 'success']);
        }
}
