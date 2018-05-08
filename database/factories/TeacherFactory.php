<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker $faker) {
    return [

        'user_id' => function () {
            return \App\User::all()->random();
        },

        'religion_id' => function () {
            return \App\Model\Religion::all()->random();
        },
        'blood_group_id' => function () {
            return \App\Model\BloodGroup::all()->random();
        },
        'gender_id' => function () {
            return \App\Model\Gender::all()->random();
        },

        'name' => $faker->name,
        'current_address' => $faker->address,
        'permanent_address' => $faker->address,
        'dob' => $faker->date('Y-m-d'),
        'national_id' => '0123456789',
        'marital_status' => '0',
        'nationality' => 'Bangladeshi',
        'cell' => '0123456789',
        'photo' => 'abc.jpg'

    ];
});
