<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registeruser(Request $request){
        $validateddata = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validateddata->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validateddata->errors()
            ]);
        }
        else{
            $data = $validateddata->validated();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);
            $token = $user->createToken('main')->plainTextToken;
            return response([
                'user' => $user,
                'token' => $token
            ]);
        }
       

    }
    

}
