<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'store_credit' => $faker->numberBetween(500, 1000),
    ];
});
