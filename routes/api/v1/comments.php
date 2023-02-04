<?php


use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

//Route::group([
//    'middleware' => [
//        'auth',
//    ],
//    'prefix' => 'kim',
//], function () {
//    Route::apiResource('comments', CommentController::class);
//});

Route::middleware([
    //'auth',
])
    ->prefix('livepost')
    ->group(function () {
        Route::apiResource('comments', CommentController::class);
    });

