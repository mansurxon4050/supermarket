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

        $user=User::where('phone_number',$request->input('phone_number'))->get();
        if($user!=null){
            return response()->json([
                'success' => false,
                'message' => 'you are already registered',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'success',
        ]);
    }
    public  function update_password(Request $request){

        #Match The Old Password
        $user=$request->user();
        if(Hash::check($request->password,$user->password)){
            $user->update([
            'password'=>Hash::make($request->newPassword)
            ]);
            return response()->json([
                'success' => true,
                'message' => 'password updated successfully',
            ]);

        }
        auth()->user()->update(['password' => Hash::make($request->password) ]);
        /*if(!Hash::check($request->password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }
        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->newPassword)
        ]);

        */
       // return $user = Auth::user();
       // return $request->user();

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
            return response()->json(['user' => auth()->user(),'api_token'=>$token,
                'url' => "http://mansurer.beget.tech/",
                'imageUrl' => "http://mansurer.beget.tech/storage/",]);
        } catch (ValidationException $e) {
            return response()->json(array_values($e->errors()));
        }
    }

    public function login(Request $request){

        $fields = $request->validate([
            'phone_number' => 'required|string',
            'password' => 'required|string ',
        ]);
        // Check email
        $user = User::where('phone_number',$fields['phone_number'] )->first();
        // Check passwords
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response()->json(['success' => false, 'message' =>"Bad creds"],401);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        $response = [
            'url' => "http://mansurer.beget.tech/",
            'imageUrl' => "http://mansurer.beget.tech/storage/",
            'user' => $user,
            'token' => $token,
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
