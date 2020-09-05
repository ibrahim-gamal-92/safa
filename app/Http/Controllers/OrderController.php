<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'telephone' => 'required'
        ]);

        $ok = Order::makeOrder($request->address, $request->telephone);
        if(!$ok){
            return ['result'=>false, 'message'=>"Payment failed"];
        }
        return ['result'=>true, 'message'=>'Payment successful'];
    }
}
