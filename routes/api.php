<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GifController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SavedGifController;
use App\Models\User;
use App\Http\Middleware\SaveLog;

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

Route::post('user/login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('getById',    [GifController::class,       'getById'])->middleware(SaveLog::class);
    Route::get('getByQuery', [GifController::class,       'getByQuery'])->middleware(SaveLog::class);
    Route::post('save',      [SavedGifController::class,  'save'])->middleware(SaveLog::class);
});
