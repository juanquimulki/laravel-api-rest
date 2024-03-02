<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\IUserService;
use App\Services\ISavedGifService;
use App\DTO\Requests\SavedGifData;
use App\Classes\StatusCodes;

class SavedGifController extends Controller
{

    private IUserService     $userService;
    private ISavedGifService $savedGifService;

    public function __construct(IUserService $userService, ISavedGifService $savedGifService)
    {
        $this->userService     = $userService;
        $this->savedGifService = $savedGifService;
    }

    public function save(Request $request): JsonResponse
    {
        $request->validate([
            "gif_id" => "required|string|min:1|max:255",
            "alias"  => "required|string|min:1|max:255",
        ]);

        $user = $this->userService->getByToken($request->bearerToken());        

        $savedGifData = new SavedGifData($request->gif_id, $request->alias, $user->id);
        $savedGif = $this->savedGifService->save($savedGifData);

        return response()->json($savedGif, StatusCodes::$CREATED);
    }
}
