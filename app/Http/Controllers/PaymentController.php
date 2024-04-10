<?php

namespace App\Http\Controllers;

use App\Models\MinutesPurchase;
use App\Models\Order;
use App\Models\Talk;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'talkId' => 'required',
        ]);
        $talk = Talk::find($request->talkId);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $res = $api->order->create(array(
            'amount' => $talk->price * 100,
            'currency' => 'INR',
            'notes' => ['talk' => $talk->id]
        ));

        $order = new Order;
        $order->order_id = $res->id;
        $order->amount = $res->amount;
        $order->talk_id = $talk->id;
        $order->order_created_at = date('Y-m-d h:i:s', $res->created_at);
        $order->user_id = auth()->user()->id;
        $order->save();
        return redirect()->back()->with(['order' => $order, 'talk' => $talk]);
    }
    public function verifyOrder(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required|exists:orders,order_id',
            'razorpay_signature' => 'required',
        ]);
        $order=Order::where('order_id',$request->razorpay_order_id)->first();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        try {
            $api->utility->verifyPaymentSignature(array('razorpay_order_id' => $request->razorpay_order_id, 'razorpay_payment_id' => $request->razorpay_payment_id, 'razorpay_signature' => $request->razorpay_signature));
            $order->is_authorized=true;
            $order->payment_id=$request->razorpay_payment_id;
            $order->save();
            return redirect("purchases")->withSuccess('Talk Purchased successfully');
        } catch (SignatureVerificationError) {
            return "Failed";
        }
    }
    public function createOrderMin(Request $request)
    {
        $request->validate([
            'quant' => 'required',
        ]);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $res = $api->order->create(array(
            'amount' => $request->quant * env('RATE_PER_MIN') * 100,
            'currency' => 'INR',
            'notes' => ['minutes' => $request->quant]
        ));

        $minOrder = new MinutesPurchase();
        $minOrder->order_id = $res->id;
        $minOrder->amount = $res->amount;
        $minOrder->order_created_at = date('Y-m-d h:i:s', $res->created_at);
        $minOrder->user_id = auth()->user()->id;
        $minOrder->save();
        return redirect()->back()->with(['minOrder' => $minOrder]);
    }
    public function verifyOrderMin(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required|exists:minute_purchases,order_id',
            'razorpay_signature' => 'required',
        ]);
        $order=MinutesPurchase::where('order_id',$request->razorpay_order_id)->first();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        try {
            $api->utility->verifyPaymentSignature(array('razorpay_order_id' => $request->razorpay_order_id, 'razorpay_payment_id' => $request->razorpay_payment_id, 'razorpay_signature' => $request->razorpay_signature));
            $order->is_authorized=true;
            $order->payment_id=$request->razorpay_payment_id;
            $order->user->minutes+=($order->amount/100)/env('RATE_PER_MIN');
            $order->user->save();
            $order->save();
            return redirect("purchases")->withSuccess('Talk Purchased successfully');
        } catch (SignatureVerificationError) {
            return "Failed";
        }
    }
}
