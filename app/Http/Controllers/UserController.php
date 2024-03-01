<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\IUserService;

class UserController extends Controller
{

    private IUserService $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = $this->userService->getByEmail($request->email);
        $loginData = $user->login($request->password);

        return response()->json(["token" => $loginData->token], $loginData->statusCode);
    }
}
