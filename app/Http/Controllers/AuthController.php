<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserAuthResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            return response()->json([
                'message' => 'Success',
                'user' => new UserAuthResource(auth()->user())
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials!',
                'errors' => [
                    'password' => 'The given password is incorrect.'
                ]
            ], 401);
        }
    }
}
