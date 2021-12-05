<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['code' => 401], 401);
        }
        else{
            $authUser = Auth::user();
            $token = $authUser->createToken('MyAuthApp')->plainTextToken;
            $authUser->load('role');
            return response()->json([ 'code'=> 200 ,'token' => $token, 'user' => $authUser],200);
        }


      }

}
