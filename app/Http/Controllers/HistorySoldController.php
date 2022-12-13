<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoryResource;
use App\Models\HistorySold;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class HistorySoldController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \JsonException
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
            'data'=> json_encode($request->data, JSON_THROW_ON_ERROR),
        ]);
        $history->save();

        return response()->json(['success' => true, 'message' =>" success"]);

    }
    public function history_search(Request $request){

        $s=$request['search'];
        $products=HistorySold::where('userId','like',"%$s%")->paginate();
        if($products!=null){
            return  HistoryResource::collection($products);
        }
        return  response()->json(['success'=>false,'data'=>[]]);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
