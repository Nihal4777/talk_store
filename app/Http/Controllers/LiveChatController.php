<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Events\UserConnected;
use App\Models\OnlineUser;
use App\Models\UserHasExpert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class LiveChatController extends Controller
{
    function realTimeChat()
    {
        event(new UserConnected(3,2));
        return ;
        $user = auth()->user();
        $expert = $this->getFreeExpert();
        if (empty($expert)) return "no expert";
        $oe = OnlineUser::where('user_id', $expert->user_id)->first();
        $oe->is_busy = true;
        $oe->save();
        $ue = new UserHasExpert;
        $ue->user_id = $user->id;
        $ue->expert_id = $expert->user_id;
        $ue->save();
        event(new UserConnected($user->id,$expert->expert_id));
        return view('liveChat', compact('user', 'expert'));
    }
    function expertLiveChat()
    {
        $user = auth()->user();
        $ue=UserHasExpert::where(['expert_id'=>$user->id])->first();
        if(empty($ue)){
            $oUser = new OnlineUser();
            $oUser->user_id = $user->id;
            $oUser->is_expert = 1;
            $oUser->save();
            return view('admin.expert.waitingPage', compact('user'));
        }
        return view('admin.expert.liveChat',compact('user','ue'));


        
    }
    public function authUser(Request $request)
    {
        // $string=$request->socket_id."::user::".'{"id":"12345"}';
        // $string = $request->socket_id . ":" . "presence-chat-".'3'."-".$user->id;
        $user = auth()->user();
        $request->validate([
            'socket_id' => 'required',
            'channel_name' => 'required'
        ]);
        $contentData = ['name' => $user->name, 'user_id' => $user->id];
        $explostion = explode('-',$request->channel_name);
        if ($user->hasRole('expert') && $explostion[1] == 'waiting') {
            $string = $request->socket_id . ":" . "presence-waiting-chat-" . $user->id . ":" . json_encode($contentData);
            $sig = hash_hmac('sha256', $string, env('PUSHER_APP_SECRET'));
            $authString = env('PUSHER_APP_KEY') . ':' . $sig;
            return response()->json(['auth' => $authString, 'channel_data' => json_encode($contentData)]);
        }
       
        if ($user->hasRole('expert')) {
            $ue = UserHasExpert::where(['expert_id' => $user->id])->first();
            $string = $request->socket_id . ":" . "presence-chat-" . $ue->user_id . "-" . $user->id . ":" . json_encode($contentData);
        } else {
            $ue = UserHasExpert::where(['user_id' => $user->id])->first();
            $string = $request->socket_id . ":" . "presence-chat-" . $ue->expert_id . "-" . $user->id . ":" . json_encode($contentData);
        }
        $sig = hash_hmac('sha256', $string, env('PUSHER_APP_SECRET'));
        $authString = env('PUSHER_APP_KEY') . ':' . $sig;
        return response()->json(['auth' => $authString, 'channel_data' => json_encode($contentData)]);
    }

    public function sendChatMessage(Request $request, $receiver_id)
    {
        $request->validate([]);
        $user = auth()->user();
        if ($receiver_id != $user->id)
            return response()->json(['message' => 'Forbidden'], 403);

        //Check for availablility of credits here


        event(new MessageSend($receiver_id, $user->id));
    }

    private function getFreeExpert()
    {
        $onlineExperts = OnlineUser::where(['is_expert' => true, 'is_busy' => false])->get();
        if(!count($onlineExperts)) return NULL;
        return $onlineExperts->random();
    }
}
