<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('reply', \App\Http\Controllers\ReplyController::class);
});
