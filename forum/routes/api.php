<?php

use App\Http\Controllers\ReplyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//auth('web')->loginUsingId(30);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('replies', [ReplyController::class, 'index']);

Route::get('replies/{reply}', [ReplyController::class, 'show']);

Route::patch('replies/{reply}', [ReplyController::class, 'update']);

Route::post('replies', [ReplyController::class, 'store']);
