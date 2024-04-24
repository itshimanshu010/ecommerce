<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function userRegister(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 0,
                'message' => $validator->errors(),
            ],400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }


    public function userApiLogin(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 0,
                'message' => $validator->errors(),
            ],400);
        }

        if(!$token = auth()->attempt($validator->validated()))
        {
            return response()->json(['error' => 'Unauthorized']);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()*60
        ]);
    }

    public function userProfile()
    {
        $user = auth()->user();

        if ($user === null) 
        {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        return response()->json($user);
    }


}
