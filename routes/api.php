<?php

use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v2')
    ->middleware(['guest'])
    ->name('api.v2.')
    ->group(function () {
        Route::get('replies', [ReplyController::class, 'index']);
        Route::get('replies/{reply}', [ReplyController::class, 'show']);
        Route::patch('replies/{reply}', [ReplyController::class, 'update']);
        Route::post('replies', [ReplyController::class, 'store']);
        Route::delete('replies/{id}', [ReplyController::class, 'destroy']);

        Route::get('threads', [ThreadController::class, 'index']);
        Route::get('threads/{thread}', [ThreadController::class, 'show']);
        Route::patch('threads/{thread}', [ThreadController::class, 'update']);
        Route::post('threads', [ThreadController::class, 'store']);
        Route::delete('threads/{id}', [ThreadController::class, 'destroy']);
    });


