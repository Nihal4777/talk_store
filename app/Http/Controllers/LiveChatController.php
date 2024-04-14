<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Events\UserConnected;
use App\Models\OnlineUser;
use App\Models\Session;
use App\Models\User;
use App\Models\UserHasExpert;
use App\Notifications\SendExpertPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
class LiveChatController extends Controller
{
    function realTimeChat($expert_id){
        $user = auth()->user();
        /* ----------------- Check if the user is already connected ----------------- */
        $expert=UserHasExpert::where(['user_id'=>$user->id,'end_time'=>NULL])->first();
        if(!empty($expert)){
            $expert=$expert->expert;
            return view('liveChat', compact('user', 'expert'));
        }
        /* ------------------------------------ - ----------------------------------- */

        /* ------------------------ Check if user has minutes ----------------------- */
        if($user->minutes<1) return redirect()->back()->with(['error' => 'No coins']);
        $expert = User::find($expert_id);

        DB::transaction(function() use ($user,$expert){
            $oe = OnlineUser::where('user_id', $expert->id)->first();
            $oe->is_busy = true;
            $oe->save();
            $ue = new UserHasExpert;
            $ue->user_id = $user->id;
            $ue->start_time = date('Y-m-d h:i:s');
            $ue->expert_id = $expert->id;
            $ue->rate_per_min = env('RATE_PER_MIN');
            $ue->save();
        });
        event(new UserConnected($expert->id));
        return view('liveChat', compact('user', 'expert'));
    }
    function realTimeChatExpertsPage(){
        $experts = OnlineUser::where(['is_expert' => true, 'is_busy' => false])->get();
        if (!count($experts)) return view('noExpert');
        return view("realTimeChatExpertsPage",compact('experts'));
    }

    function expertLiveChat(){
        $user = auth()->user();
        $ue=UserHasExpert::where(['expert_id'=>$user->id,'end_time'=>NULL])->first();
        if(empty($ue)){
            OnlineUser::where(['user_id'=>$user->id,'is_expert'=>true])->delete();
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
            $ue = UserHasExpert::where(['expert_id' => $user->id,'end_time'=>NULL])->first();
            $string = $request->socket_id . ":" . "presence-chat-" . $ue->user_id . "-" . $user->id . ":" . json_encode($contentData);
        } else {
            $ue = UserHasExpert::where(['user_id' => $user->id,'end_time'=>NULL])->first();
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

    public function manageExpertsPage(Request $request){
        $experts = User::whereHas(
            'roles', function($q){
                $q->where('name', 'expert');
            }
        )->get();
        return view("admin.manageExperts",compact('experts'));
    }

    public function addExperts(Request $request){
        $request->validate(['name'=>'required',
        'email'=>'required|email:rfc,dns']);
        $user=User::withTrashed()->firstOrNew([
            'email' => $request->email
        ]);
        if ($user->trashed()) {
            $user->restore();
            $pwd=Str::random('8');
            $user->password=Hash::make($pwd);
            $user->save();
            $user->assignRole('expert');
            $user->notify(new SendExpertPassword($request->email,$pwd));
            return redirect()->back()->with('success','User Restored Successfully');
        }        
        $user->name=$request->name;
        $user->email=$request->email;
        $user->email_verified_at=date("d-m-Y h:i:s");
        $pwd=Str::random('8');
        $user->password=Hash::make($pwd);
        $user->save();
        $user->assignRole('expert');
        $user->notify(new SendExpertPassword($request->email,$pwd));
        return redirect()->back()->with('success','User Added Successfully');
    }
    public function removeExpert($expert){
        $user=User::find($expert);
        if($user->hasRole('expert'))
            $user->delete();
        return redirect()->back()->with('success','Expert Removed');;
    }

    // private function getFreeExpert()
    // {
    //     $onlineExperts = OnlineUser::where(['is_expert' => true, 'is_busy' => false])->get();
    //     if(!count($onlineExperts)) return NULL;
    //     return $onlineExperts->random();
    // }
}
