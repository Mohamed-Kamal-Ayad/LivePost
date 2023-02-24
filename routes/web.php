<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testmail', function () {
    $user = \App\Models\User::factory()->make();
    \Illuminate\Support\Facades\Mail::to($user)->send(new \App\Mail\WelcomeMail($user));
return null;
});
Route::get('/playground', function () {
    event(new \App\Events\PlaygroundEvent());
    return null;
});

Route::get('/ws', function () {
    return view('websocket');
});

Route::post('/chat-message', function (\Illuminate\Http\Request $request) {
    $message = $request->get('message');
    event(new \App\Events\ChatMessageEvent($message, Auth::user()));
    return null;
});
