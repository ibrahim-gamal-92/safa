<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    protected $fillable = ['customer_id', 'total', 'address', 'telephone'];

    static public function makeOrder($address, $telephone,$customer_id = 1){
        $customer = Customer::find($customer_id);
        $totalPrice = Cart::getTotalPrice($customer_id);
        if($totalPrice > $customer->store_credit){
            return false;
        }
        $customer->update([
            'store_credit' => $customer->store_credit - $totalPrice
        ]);
        Order::create([
           'customer_id' => $customer->id,
           'total' => $totalPrice,
           'address' => $address,
           'telephone' => $telephone,
        ]);
        Cart::truncate(); // we should have another table to link between order and its items
        return true;
    }
}
