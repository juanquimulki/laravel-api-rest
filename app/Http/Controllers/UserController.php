<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Classes\StatusCodes;

class UserController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = User::where('email', $request->email)->first();

        $token = null;
        if (Hash::check($request->password, $user->password)) {
            $token      = $user->createToken('My Token')->accessToken;
            $statusCode = StatusCodes::$OK;            
        } else {
            $statusCode = StatusCodes::$UNAUTHORIZED;
        }

        return response()->json(["token" => $token], $statusCode);
    }

    public function token(Request $request) {
        $user = User::where('email', 'juanqui@hotmail.com')->first();
        $token = $user->createToken('My Token')->accessToken;
        $response = ['token' => $token];
        return response()->json($response);
    }
}
