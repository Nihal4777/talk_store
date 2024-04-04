<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Talk;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate(['talkId'=>'required',
    ]);
        $talk=Talk::find($request->talkId);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $res=$api->order->create(array(
        'receipt' => '123',
        'amount' => $talk->price*100, 
        'currency' => 'INR',
        'notes'=>['talk'=>$talk->id]
        ));

        $order=new Order;
        $order->order_id=$res->id;
        $order->amount=$res->amount;
        $order->talk_id=$talk->id;
        $order->order_created_at=date('Y-m-d h:i:s',$res->created_at);
        $order->user_id=auth()->user()->id;
        $order->save();
        return redirect()->back()->with(['order'=>$order,'talk'=>$talk]);
    }
}
