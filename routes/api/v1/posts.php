<?php


use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//Route::group([
//    'middleware' => [
//        'auth',
//    ],
//    'prefix' => 'kim',
//], function () {
//    Route::apiResource('posts', PostController::class);
//});

Route::middleware([
    //'auth',
])
    ->group(function () {
        Route::apiResource('posts', PostController::class);
    });
