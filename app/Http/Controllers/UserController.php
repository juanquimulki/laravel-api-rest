<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function token(Request $request) {
        $user = User::where('email', 'juanqui@hotmail.com')->first();
        $token = $user->createToken('My Token')->accessToken;
        $response = ['token' => $token];
        return response()->json($response);
    }
}
