<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::group([
//    'middleware' => [
//        'auth',
//    ],
//    'prefix' => 'kim',
//], function () {
//    Route::apiResource('users', UserController::class);
//});

Route::middleware([
    'auth',
])
    ->prefix('livepost')
    ->group(function () {
        Route::apiResource('users', UserController::class);
    });

