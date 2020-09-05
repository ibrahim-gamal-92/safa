<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;

    protected $fillable = ['email', 'first_name', 'last_name', 'store_credit'];

}
