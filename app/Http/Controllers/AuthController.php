<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserAuthResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!User::whereEmail($request->email)->exists()) {
            $user = new User();
            $user->email = $request->email;
            $user->name = 'User';
            $user->password = bcrypt($request->password);
            $user->save();
         }
        if (Auth::attempt($request->validated())) {
            return response()->json([
                'message' => 'Login Successful!',
                'user' => new UserAuthResource(auth()->user())
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials!',
                'errors' => [
                    'password' => ['The given password is incorrect.']
                ]
            ], 422);
        }
    }
}
