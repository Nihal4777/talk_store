<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Models\ChatMessage;
use App\Models\Order;
use App\Models\TalkMessage;
use App\Models\UserHasExpert;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function sendMessage(Request $request){
        $user = auth()->user();
        $request->validate([
            'message' => 'required', 'seq' => 'required', 'talk_id' => ['required', Rule::exists('chat_messages')->where(function ($query) use ($user) {
                return $query->where(['user_id' => $user->id]);
            })]

        ]);
        $totalCount=TalkMessage::where(['talk_id' => $request->talk_id])->count();
        $completedCount=ChatMessage::where(['talk_id' => $request->talk_id,'user_id'=>$user->id])->count();
        $tm = TalkMessage::where(['talk_id' => $request->talk_id])->whereIn('seq', [$request->seq, $request->seq + 1])->get();
        if($totalCount>$completedCount){
            $cm = new ChatMessage();
            $cm->line_message = $request->message;
            $cm->user_id = $user->id;
            $cm->talk_id = $request->talk_id;
            $cm->save();
            $completedCount+=1;
            if (count($tm) > 1) {
                $cm = new ChatMessage();
                $cm->user_id = $user->id;
                $cm->talk_id = $request->talk_id;
                $cm->line_message = $tm[1]->message;
                $cm->save();
                $completedCount+=1;
                $responseData=['nextMessage' => $tm[1]->message, 'nextSeq' => '', 'accuracy' => similar_text($request->message, $tm[0]->message), 'isEnd' => $completedCount==$totalCount];
            } else {
                $responseData=['nextMessage' => NULL, 'nextSeq' => '', 'accuracy' => similar_text($request->message, $tm[0]->message), 'isEnd' => $completedCount==$totalCount];
            }
            $order=Order::where(['talk_id'=>$request->talk_id,'user_id'=>$user->id])->first();
            $order->progress=$completedCount/$totalCount*100;
            $order->save();
            return response()->json($responseData);
        }
        return response()->json(400);
    }
    function sendChatMessage(Request $request){
        $user=auth()->user();
        $request->validate(['message'=>'required']);
        if($user->hasRole('expert')){
            $ue=UserHasExpert::where(['expert_id'=>$user->id])->first();
            event(new MessageSend($user->id,$ue->user_id,$request->message));
            return response()->json(['status' => true,'x'=>$user->id.'-'.$ue->user_id.'-'.$request->message]);
        }
        else{
            $ue=UserHasExpert::where(['user_id'=>$user->id,'end_time'=>NULL])->first();
            $timestamp2 = strtotime(date('Y-m-d h:i:s'));
            $timestamp1 = strtotime($ue->start_time);
            $minutes=($timestamp2-$timestamp1)/60;
            if(ceil($minutes)>$user->minutes){
                return response()->json(['status' => false]);
            }
            event(new MessageSend($user->id,$ue->expert_id,$request->message));
            return response()->json(['status' => true,'x'=>$ue->expert_id.'-'.$user->id.'-'.$request->message]);
        }
    }
}
