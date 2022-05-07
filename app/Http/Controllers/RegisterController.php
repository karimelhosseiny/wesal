<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function register(Request $request){
       $data = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|string|unique:users,email',
        'password' =>[
            'required',
            'confirmed',
            Password::min(8)->mixedCase()->numbers()->symbols()
        ]
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $token = $user->createToken('main')->plainTextToken;
        return response([
            'user' =>$user,
            'token' => $token
        ]);

    }

}
