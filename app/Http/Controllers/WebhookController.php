<?php

namespace App\Http\Controllers;

use App\Models\OnlineUser;
use App\Models\User;
use App\Models\UserHasExpert;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function mark_online(Request $request)
    {
        $req = json_decode($request->getContent());
        $user=User::find($req->events[0]->user_id);
        if ($req->events[0]->name == "member_added") {
            $oUser = new OnlineUser();
            $oUser->user_id = $req->events[0]->user_id;
            $oUser->is_expert=$user->hasRole('expert');
            $oUser->save();
        } else {
            if($user->hasRole('user')){
                $ue=UserHasExpert::where(['user_id'=>$user->id])->first();
                $oe=OnlineUser::where(['user_id'=>$ue->expert_id,'is_busy'=>true])->get()->first();
                if(!empty($oe)){
                    $oe->is_busy=false;
                    $oe->save();
                    $ue->delete();
                }
                OnlineUser::where('user_id',$req->events[0]->user_id)->first()->delete();
            }
        }
    }
}
