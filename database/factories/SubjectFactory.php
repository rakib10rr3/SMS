<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Subject::class, function (Faker $faker) {
    return [

        'class_id' => function () {
            return \App\Model\TheClass::all()->random();
        },

        'group_id' => function () {
            return \App\Model\Group::all()->random();
        },


        'code' => '0123456789',
        'name' =>  $faker->name,
        'full_marks' => '100',
        'pass_marks' => '50',
        'has_written' => '1',
        'written_marks' => '50',
        'written_pass_marks' => '20',
        'has_mcq' => '1',
        'mcq_marks' =>'30',
        'mcq_pass_marks' => '20',
        'has_practical' => '1',
        'practical_marks' => '20',
        'practical_pass_marks' => '10',
        'is_optional' => '0',



        //
    ];
});
