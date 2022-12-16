<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistorySoldResource;
use App\Models\HistorySold;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;

class HistorySoldController extends Controller
{

    public function history_index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $id=$request->userId;
        $historys=HistorySold::where('user_id',$id)->paginate();
            return HistorySoldResource::collection($historys);
    }

    public function history_accepted(Request $request): JsonResponse
    {
        $id=$request->id;
        $historys=HistorySold::where('id',$id);
        $historys->update(['accepted' => '1']);
        $historys->update(['accepted_time' => $request->accepted_time]);
        $historys->save();
        return  HistorySold::where('id',$id);
       /* return response()->json(['success' => true, 'message' =>" success"]);*/
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
            'accepted'=>$request->accepted,
            'order_time'=>$request->order_time,
            'accepted_time'=>$request->accepted_time,

            'data'=> json_encode($request->data, JSON_THROW_ON_ERROR),
        ]);
        $history->save();

        return response()->json(['success' => true, 'message' =>" success"]);

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
    public function edit($id)
    {
        //
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
     * @param int $id
     * @return JsonResponse
     * @throws JsonException
     */
    public function history_delete(Request $request)
    {
        $historys=HistorySold::where('user_id',$request->id)->delete();

        return response()->json(['success' => true, 'data' =>$historys]);
    }
}
