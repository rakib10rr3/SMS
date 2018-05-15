<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Student::class, function (Faker $faker) {
    // $newuser = \App\User::create([
    //     'name' => $faker->word
    // ]);

    // $word = $faker->unique()->word;

    return [
        'user_id' => function () {
            return \App\User::create(['name' => $this->faker->word]);
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
        'shift_id' => function () {
            return \App\Model\Shift::all()->random();
        },
        'the_class_id' => function () {
            return \App\Model\TheClass::all()->random();
        },
        'section_id' => function () {
            return \App\Model\Section::all()->random();
        },
        'group_id' => function () {
            return \App\Model\Group::all()->random();
        },
        'name' => $faker->name,
        'father_name' => $faker->name,
        'mother_name' => $faker->name,
        'local_guardian_name' => $faker->name,
        'father_cell' => '0123456789',
        'mother_cell' => '0123456789',
        'local_guardian_cell' => '0123456789',
        'nationality' => 'Bangladeshi',
        'extra_activity' => $faker->text,
        'current_address' => $faker->address,
        'permanent_address' => $faker->address,
        'roll' => $faker->numberBetween(1,100),
        'admission_year' => $faker->year,
        'cell' => '0123456789',
        'dob' => $faker->date('Y-m-d'),
        'photo' => 'abc.jpg',
    ];
});
