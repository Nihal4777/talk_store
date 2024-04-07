<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\TalkMessage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function sendMessage (Request $request) {
        $user=auth()->user();
        $request->validate(['message'=>'required','seq'=>'required','talk_id'=>['required', Rule::exists('chat_messages')->where(function ( $query) use ($user){
            return $query->where(['user_id'=>$user->id]);
        })]

    ]);
        $tm=TalkMessage::where(['talk_id'=>$request->talk_id])->whereIn('seq',[$request->seq,$request->seq+1])->get();
        if(count($tm)>1){
            $cm=new ChatMessage();
            $cm->line_message=$request->message;
            $cm->user_id=$user->id;
            $cm->talk_id=$request->talk_id;
            $cm->save();

            $cm=new ChatMessage();
            $cm->user_id=$user->id;
            $cm->talk_id=$request->talk_id;
            $cm->line_message=$tm[1]->message;
            $cm->save();
            return response()->json(['nextMessage'=>$tm[0]->message,'nextSeq'=>$tm[0]->seq,'accuracy'=>similar_text($request->message,$tm[0]->message),'isEnd'=>false]);
        }
        else{
            return response()->json(['nextMessage'=>'','nextSeq'=>'','accuracy'=>similar_text($request->message,$tm[0]->message),'isEnd'=>true]);
        }
    }
}
