<?php

use Illuminate\Support\Facades\Broadcast;
use App\ChatSession;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{session_id}', function ($session_id) {
    $session = ChatSession::find($session_id);
    $user = Auth::user();
    if ($user->id == $session->{$user->role}.'_id' and !$session->blocked) {
        return true;
    }
    return false;
});
