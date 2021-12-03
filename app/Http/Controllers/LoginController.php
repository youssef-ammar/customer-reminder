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
                ->json(['message' => 'Unauthorized'], 401);
        }
        else{
            $authUser = Auth::user();
            $token = $authUser->createToken('MyAuthApp')->plainTextToken;
            return response()->json(['message' => 'Success','access_token' => $token,'code'=>200 ]);
        }


      }

}
