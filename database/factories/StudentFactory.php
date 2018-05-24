<?php

use App\Model\Preference;
use Faker\Generator as Faker;

$factory->define(App\Model\Student::class, function (Faker $faker) {

    // Get the last reg id
    $reg_id = intval(Preference::query()->where('key', 'student_id_counter')->value('value'));

    // Update the preference
    $new_reg_id = intval($reg_id) + 1;
    Preference::query()->where('key', 'student_id_counter')
        ->update(['value' => $new_reg_id]);

    // Here, S for Student
    $username = 'S' . date('y') . str_pad($reg_id, 4, "0", STR_PAD_LEFT);

    return [
        'user_id' => function () use ($username) {
            return factory(App\User::class)->create(['role_id' => 1, 'username' => $username])->id;
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
        'father_cell' => '01866803833',
        'mother_cell' => '01866803833',
        'local_guardian_cell' => '01866803833',
        'nationality' => 'Bangladeshi',
        'extra_activity' => $faker->text,
        'current_address' => $faker->address,
        'permanent_address' => $faker->address,
        'roll' => $faker->numberBetween(1,100),
        'admission_year' => $faker->year,
        'cell' => '01866803833',
        'session' => $faker->year,
        'dob' => $faker->date('Y-m-d'),
        'photo' => 'demo.jpg',
    ];
});
