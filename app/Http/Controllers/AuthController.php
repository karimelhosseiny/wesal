<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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


    //create log in function
    public function loginuser(Request $request){
        $validateddata = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validateddata->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validateddata->errors()
            ]);
        }
        else{
            $data = $validateddata->validated();
            $user = User::where('email', $data['email'])->first();
            if($user){
                if(password_verify($data['password'], $user->password)){
                    $token = $user->createToken('main')->plainTextToken;
                    return response([
                        'user' => $user,
                        'token' => $token,
                        
                    ]);
                }
                else{
                    return response()->json([
                        'status' => 'error',
                        'errors' => 'Invalid password'
        ]);
    }
        }
        else{
            return response()->json([
                'status' => 'error',
                'errors' => 'Invalid email'
            ]);
        }
    }
}
//create log out function
public function logoutuser(Request $request){
    $request->user()->token()->revoke();
    return response()->json([
        'status' => 'success',
        'message' => 'Successfully logged out'
    ]);
}
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
 
    $user = User::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    $user->createToken($request->device_name)->plainTextToken;
    return response([
        'user' => $user,
        'token' => $token
    ]);
}
public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();
    return response()->json([
        'status' => 'success',
        'message' => 'Successfully logged out'
    ]);
}
}