<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
class OrdersController extends Controller
{
    public function create_order(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $api->order->create(array(
        'receipt' => '123',
        'amount' => 100, 
        'currency' => 'INR', 
        'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
    }
}
