<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Validator;
use Auth;
class AdminAuthController extends Controller
{
    //
    public function signUp(Request $request){
        $data = [
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => bcrypt($request['password'])
    ];

        $rules = [
            'name' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  response()->json(["message" => $validator->errors()->first()],400);
        }


        $admin = Admin::Create($data);
        $token = $admin->createToken('Personal Access Token')->accessToken;
        return response(['token' => $token], 200);
    }

    public function logIn(Request $request){
        
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  response()->json(["message" => $validator->errors()->first()],400);
        }
        
        $admin = Admin::where('email',$request['email'])->first();

        if( $admin == null ) 
        return response( array( "message" => "Email does not exist"  ), 400 );
        
        
        if(password_verify($request['password'],$admin->password)){
            return response( array( "message" => "Sign In Successful", "data" => [
                "admin" => $admin,
                "token" => $admin->createToken('Personal Access Token',['admin'])->accessToken
            ]  ), 200 );
        } else {
            return response( array( "message" => "Wrong Password." ), 400 );
        }
        
    }

    public function logOut(){ 
        if (Auth::check()) {
            auth()->user()->token()->revoke();
            return response(['msg' => 'Logged Out Successfully!']);
         }
    }
    public function details(){ 
        $admin = auth()->user();
        return response(['data' => $admin]);
    }
}
