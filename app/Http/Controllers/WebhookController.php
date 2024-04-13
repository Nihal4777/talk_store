<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Events\UserDisconnected;
use App\Models\OnlineUser;
use App\Models\User;
use App\Models\UserHasExpert;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function mark_online(Request $request)
    {
        $req = json_decode($request->getContent());
        $user = User::find($req->events[0]->user_id);
        // if ($req->events[0]->name == "member_added" && !$user->hasRole('expert')) {
        if ($req->events[0]->name == "member_added") {
                // OnlineUser::where('user_id', $req->events[0]->user_id)->delete();
                // $oUser = new OnlineUser();
                // $oUser->user_id = $req->events[0]->user_id;
                // $oUser->is_expert = 0;
                // $oUser->save();
        } else {
            /* ---------------------------- User Disconnected --------------------------- */
            if ((!empty($user)) && $user->hasRole('user')) {
                $ue = UserHasExpert::where(['user_id' => $user->id,'end_time'=>NULL])->first();
                (!empty($ue)) && $oe = OnlineUser::where(['user_id' => $ue->expert_id, 'is_busy' => true])->get()->first();
                if (!empty($oe)) {
                    $oe->is_busy = false;
                    $oe->save();
                }
                if(!empty($ue)){
                    (!empty($ue)) && $ue->end_time=date('Y-m-d h:i:s');
                    (!empty($ue)) && $ue->save();
                    $timestamp2 = strtotime($ue->end_time);
                    $timestamp1 = strtotime($ue->start_time);
                    $minutes=($timestamp2-$timestamp1)/60;
                    $user->minutes-=floor($minutes)>0?floor($minutes)>0:$user->minutes;
                    $user->save();
                    (!empty($ue)) && event(new UserDisconnected($user->id,$ue->expert_id));
                }
            }
            else if((!empty($user)) && $user->hasRole('expert')){
                $st=explode('-',$request->events[0]['channel']);
                if($st[1]=='waiting'){
                    $ue = OnlineUser::where(['user_id' => $user->id,'is_busy'=>false])->first();
                    $ue->delete();
                    return ;
                }
                $ue = UserHasExpert::where(['expert_id' => $user->id,'end_time'=>NULL])->first();
                OnlineUser::where('user_id', $user->id)->delete();
                (!empty($ue)) && event(new UserDisconnected($user->id,$ue->user_id));
                if(!empty($ue)){
                    $ue->end_time=date('Y-m-d h:i:s');
                    $ue->save();
                    $timestamp2 = strtotime($ue->end_time);
                    $timestamp1 = strtotime($ue->start_time);
                    $minutes=($timestamp2-$timestamp1)/60;
                    $ue->user->minutes-=floor($minutes)>0?floor($minutes)>0:$ue->user->minutes;
                    $ue->user->save();
                }
            }
        }
    }
}
