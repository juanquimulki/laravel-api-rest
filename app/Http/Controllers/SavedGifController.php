<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SavedGif;
use App\Classes\StatusCodes;

class SavedGifController extends Controller
{
    public function save(Request $request) {
        $request->validate([
            "gif_id" => "required|string|min:1|max:255",
            "alias"  => "required|string|min:1|max:255",
        ]);

        $user = User::getUserByToken($request->bearerToken());        

        $savedGif = new SavedGif();

        $savedGif->gif_id  = $request->gif_id;
        $savedGif->alias   = $request->alias;
        $savedGif->user_id = $user->id;

        $savedGif->save();

        return response()->json($savedGif, StatusCodes::$CREATED);
    }
}
