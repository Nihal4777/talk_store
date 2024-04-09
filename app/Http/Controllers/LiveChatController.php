<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class LiveChatController extends Controller
{
    function realTimeChat()
    {
        $user = auth()->user();
        return view('liveChat', compact('user'));
    }

    public function authUser(Request $request)
    {
        $user=auth()->user();
        $request->validate([
            'socket_id' => 'required',
            'channel_name' => 'required'
        ]);
        // $string=$request->socket_id."::user::".'{"id":"12345"}';

        $string = $request->socket_id . ":" . "private-chat-".'9'."-".$user->id;
        $sig = hash_hmac('sha256', $string, env('PUSHER_APP_SECRET'));
        $authString = env('PUSHER_APP_KEY') . ':' . $sig;
        return response()->json(['auth' => $authString]);
    }

    function sendChatMessage(Request $request, $receiver_id)
    {
        $request->validate([]);
        $user = auth()->user();
        if ($receiver_id != $user->id)
            return response()->json(['message' => 'Forbidden'], 403);

        //Check for availablility of credits here

        
        event(new MessageSend($receiver_id, $user->id));
    }
}
