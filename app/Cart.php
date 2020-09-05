<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    public $timestamps = false;

    protected $fillable = ['item_id', 'customer_id', 'quantity'];


    public function item(){
        return $this->hasOne(Item::class,'id', 'item_id');
    }


    static public function getTotalPrice($customer_id){
        return DB::select('SELECT SUM(`items`.`price` * carts.quantity) AS total FROM `carts`
                                LEFT JOIN `items` ON `carts`.`item_id` = `items`.`id`
                                WHERE carts.customer_id = ?', [$customer_id])[0]->total;
    }

}
