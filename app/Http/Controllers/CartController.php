<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        return Cart::with('item')->where('customer_id', 1)->get()->toArray();
    }


    public function add(Request $request){
        $request->validate([
            'item_id' => 'required|numeric'
        ]);

        $ok = Cart::where('item_id', $request->item_id)->where('customer_id', 1)->first();
        if($ok){
            return ['result'=>false];
        }
        $cart = Cart::create([
            'item_id' => $request->item_id,
            'quantity' => 1,
            'customer_id' => 1,
        ]);
        return ['result'=>true, 'object'=>$cart->toArray()];
    }


    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|numeric'
        ]);
        $ok = $cart->update([
            'quantity' => $request->quantity
        ]);
        if(!$ok){
            return ['result'=>false];
        }
        return ['result'=>true, 'object'=>$cart->toArray()];
    }


    public function delete(Cart $cart)
    {
        return ['result'=> $cart->delete()];
    }
}
