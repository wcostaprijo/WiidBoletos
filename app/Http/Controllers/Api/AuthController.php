<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    /**
     * Login to a user with email and password.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (!$token = auth('api')->setTTL(10)->attempt($request->only(['email', 'password']))) {
            return response()->json(['error' => 'E-mail e/ou senha inválidos.'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     * Time to expiry in 10 minutes
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ], 200);
    }

    /**
     * Register a new user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(\App\Http\Requests\User\StoreRequest $request)
    {
        $request->merge(['password' => \Hash::make($request->password)]);
        return response()->json(User::create($request->only('name','last_name','email','password')), 201);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user(), 200);
    }
}
