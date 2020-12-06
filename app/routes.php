<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function () {
    Route::resource('reply', \App\Http\Controllers\ReplyController::class);
});
