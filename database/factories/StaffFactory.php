<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Staff::class, function (Faker $faker) {
    return [

        'user_id' => function () {
            return factory(App\User::class)->create(['role_id' => 3])->id;
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
