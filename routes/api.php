<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GifController;
use App\Http\Controllers\UserController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('auth:api')->group(function () {
    Route::get('/getById',    [GifController::class, 'getById']);
    Route::get('/getByQuery', [GifController::class, 'getByQuery']);
    Route::get('/save',       [GifController::class, 'save']);
});


Route::post('/user', function() {
    $user = new User();
    $user->name = "Juanqui Mulki";
    $user->email = "juanqui@hotmail.com";
    $user->password = "123456789";
    $user->save();

    return response()->json($user);
});

Route::get('/token', [UserController::class, 'token']);
