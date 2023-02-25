<?php

use App\Events\ChatMessageEvent;
use App\Events\PlaygroundEvent;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Websockets\SocketHandler\UpdatePostSocketHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
    $user = User::factory()->make();
    Mail::to($user)->send(new WelcomeMail($user));
return null;
});
Route::get('/playground', function () {
    event(new PlaygroundEvent());
    return null;
});

Route::get('/ws', function () {
    return view('websocket');
});

Route::post('/chat-message', function (Request $request) {
    $message = $request->get('message');
    event(new ChatMessageEvent($message, Auth::user()));
    return null;
});

WebSocketsRouter::webSocket('/socket/update-post', UpdatePostSocketHandler::class);
