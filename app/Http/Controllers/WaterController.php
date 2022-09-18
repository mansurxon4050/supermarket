<?php

namespace App\Http\Controllers;

use App\Http\Resources\WaterResource;
use App\Models\User;
use App\Models\Water;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class WaterController extends Controller
{

    public function service(Request $request)
    {
        $performers = Water::paginate(5);


        return WaterResource::collection($performers);
    }

    public function index()
    {
        $user= Water::all();

        // return response()->json($user);


    }


    public function store(Request $request)
    {
        $user=User::create(
            $request->only('first_name','last_name','email')
            +['password'=>Hash::make(1234)]
        );



        return response($user,Response::HTTP_CREATED);
    }


    public function show($id)
    {
        return Water::find($id);
    }



    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $user->update($request->only('first_name','last_name','email'));
        return response($user,200
        /*Response::HTTP_CREATED*/
        );
    }


    public function destroy($id)
    {
        $user=User::destroy($id);
        return response(null    ,200
        /*Response::HTTP_NO_CONTENT*/
        );


    }
}
