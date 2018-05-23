<?php

use App\Model\Preference;
use Faker\Generator as Faker;

$factory->define(App\Model\Staff::class, function (Faker $faker) {

    // Get the last reg id
    $reg_id = intval(Preference::query()->where('key', 'staff_id_counter')->value('value'));

    // Update the preference
    $new_reg_id = intval($reg_id) + 1;
    Preference::query()->where('key', 'staff_id_counter')
        ->update(['value' => $new_reg_id]);

    // Here, C for Clerk
    $username = 'C' . date('y') . str_pad($reg_id, 4, "0", STR_PAD_LEFT);

    return [
        'user_id' => function () use ($username) {
            return factory(App\User::class)->create(['role_id' => 3, 'username' => $username])->id;
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
        'photo' => 'demo.jpg'
    ];
});
