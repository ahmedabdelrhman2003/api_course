<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRegister;
use App\Http\Requests\V1\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpReponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    use HttpReponses;
    function login(LoginRegister $request)
    {

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error(
                '',
                'email or password wrong',
                401
            );
        }
        $user = User::where('email', $request->email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ]);
    }
    function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        return $this->success([
            'user' => $user->name,
            'token' => $user->createToken('Api Token of ' . $user->name)->plainTextToken
        ]);
    }
    function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->success(null, 'loged out successfully');
    }
}
