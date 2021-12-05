<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
class UserController extends Controller
{
    public function addUser(Request $request){

        $user = User::where('email', '=', $request->email)->first();
        if ($user==null){

            $user = User::create([
                'role_id'=>'2',
                'email' => $request-> email,
                'password' =>bcrypt($request->password),


            ]);


            $user->save();

            return response()->json(['message' => 'Success'], 200);
        }
        elseif ($user != null){
            return response()->json(['message' => 'User exist'], 400);

        }
        else {return response()->json(['message' => 'Problem inconnue'], 402);}
    }
}
