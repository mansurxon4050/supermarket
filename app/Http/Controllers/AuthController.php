<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function update_check(Request $request){

        $user=User::where('email',$request->input('email'))->get();
        if($user!=null){
            return \response($user,200);
        }
    }
    public  function update_password(Request $request){

        $user=User::where('email',$request->input('email'))->get();

        $user->password = $request->get('password');
        $user->save();
        return response()->json([
            'success' => true,
            'data' => [
                'password' => 'password updated successfully',
                'password'=>$user->password
            ]
        ]);

    }


    public function register(RegisterRequest $request){


        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            $token =   $user->createToken('api_token')->plainTextToken;
            $user->api_token = $token;
            $user->remember_token = Str::random(60);
            $user->save();
            Auth::login($user);
            return response()->json(['user' => auth()->user(),'api_token'=>$token]);
        } catch (ValidationException $e) {
            return response()->json(array_values($e->errors()));
        }
    }

    public function login(Request $request){

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string ',
        ]);
        // Check email
        $user = User::where('email',$fields['email'] )->first();
        // Check passwords
        if(!$user || !Hash::check($fields['password'],$user->password)){

            return response(['message' =>'Bad creds'],401);
        }

       // $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
         //   'token' => $token,
        ];

        return response($response, 201);
    }

    public function user(Request $request){

        return $request->user();
    }
    public function logout(){

        $cookie=Cookie::forget('token');

        return \response([
            'message'=>'success'
        ])->withCookie($cookie);

    }
}
