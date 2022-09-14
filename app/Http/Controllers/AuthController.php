<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(['name' => 'required', 'email' => 'required|email', 'password' => 'required']);
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)]);
        $token = $user->createToken($user->name)->accessToken;
        return response(['status' => true, 'message' => ['user' => $user, 'token' => $token]]);
    }

    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        try {
            $user = User::where('email', $request->email)->first();
            if(!$user){
                return response(['status' => false, 'message' => 'User not found !']);
            }else{
                if(Hash::check($request->password, $user->password)){
                    $token = $user->createToken($user->name)->accessToken;
                    return response(['status' => true, 'message' => ['user' => $user, 'token' => $token]]);
                }else{
                    return response(['status' => false, 'message' => 'Wrong Password !']);
                }
            }
        } catch (\Exception $e) {
            return response(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function logout(Request $request){
        $token = $request->user()->token();
        $token->revoke();
        return response(['status' => true, 'message' => 'Successfully Logout']);
    }
}
