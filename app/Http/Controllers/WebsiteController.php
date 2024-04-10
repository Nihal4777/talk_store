<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ChatMessage;
use App\Models\Order;
use App\Models\Talk;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function homepage(Request $request){
        $categories = Category::get();
        $talks = Talk::get();
        return view('welcome', compact('talks', 'categories'));
    }
    public function talks(Request $request){
        $categories = Category::get();
        if(!empty($request->cat))
            $talks = Talk::where('category_id',$request->cat)->get();
        else
            $talks = Talk::get();
        return view('talks', compact('talks', 'categories'));
    }
    public function purchasesPage(Request $request){
        $talks = Order::where(['is_authorized' => true, "user_id" => auth()->user()->id])->orderByDesc('updated_at')->get();
        return view('puchasesPage', compact('talks'));
    }
    public function conversationPage(Request $request, $talk_id)
    {
        $user = auth()->user();
        $order = Order::where(
            [
                'talk_id' => $talk_id,
                'user_id' => $user->id,
                'is_authorized' => true,
            ]
        )->first();
        if (empty($order))
            return redirect('/purchases');
        $talk = $order->talk;
        /* --------------------- Check if its new conversation -------------------*/
        $cm = ChatMessage::where([
            'talk_id' => $talk_id,
            'user_id' => auth()->user()->id,
        ]);
        if (!$cm->count()) {
            $cm = new ChatMessage();
            $cm->user_id = $user->id;
            $cm->talk_id = $talk->id;
            $cm->line_message = $talk->script->first()->message;
            $cm->save();
            $cm = new Collection([$cm]);
            return view('conversationPage', compact('cm', 'talk'));
        }
        $cm = $cm->get();
        return view('conversationPage', compact('cm', 'talk'));
    }
}
