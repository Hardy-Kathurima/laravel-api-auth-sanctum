<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){

    $validator   = Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required|confirmed'
    ]);

    if($validator->fails()){
        return response()->json(['status_code'=>400,'message'=>'Bad request']);
    }

        $user = User::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'password'=> bcrypt($request->password)
        ]
        );

      $token = $user->createToken('token')->plainTextToken;

      $response = [
        'user'=>$user,
        'token'=>$token
      ];

      return response($response,201);
    }

    public function login(Request $request){
        $validator   = Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required'
        ]);

        if($validator->fails()){
            return response()->json(['status_code'=>400,'message'=>'Bad request']);
        }

        $credentials =request(['email','password']);

        if(!Auth::attempt($credentials)){

            return response()->json([
                'status_code'=>500,
                'message'=>'Unauthorized'
            ]);

        }

        $user = User::where('email',$request->email)->first();

        $generateToken = $user->createToken('token')->plainTextToken;

        return response()->json([
            'status_code'=>200,
            'token'=>$generateToken

        ]);

    }

    public function logout(Request $request){
       $request->user()->currentAccessToken()->delete();
       return response()->json([
        'status_code'=>200,
        'message'=>'User has been logged out'
    ]);

        
    }

    
}
