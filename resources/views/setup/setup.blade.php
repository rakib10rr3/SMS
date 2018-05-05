<?php
/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 05/05/2018
 * Time: 11:13 AM
 */

use App\Model\BloodGroup;

$bloodGroups = BloodGroup::query()->get();
if (count($bloodGroups) == 0) {
    BloodGroup::insert([
        [
            'name' => 'A+',
        ],
        [
            'name' => 'A-',
        ],
        [
            'name' => 'B+',
        ],
        [
            'name' => 'B-',
        ],
        [
            'name' => 'O+',
        ],
        [
            'name' => 'O-',
        ],
        [
            'name' => 'AB+',
        ],
        [
            'name' => 'AB-',
        ],
    ]);
} else {
    echo "Blood Groups data already exist<br>";
}

$religions = \App\Model\Religion::query()->get();
if (count($religions) == 0) {
    \App\Model\Religion::insert([
        [
            'name' => 'Islam',
        ],
        [
            'name' => 'Hinduism',
        ],
        [
            'name' => 'Buddhism',
        ],
        [
            'name' => 'Christianity',
        ],
        [
            'name' => 'Others',
        ],
    ]);
} else {
    echo "Religion data already exist<br>";
}

$genders = \App\Model\Gender::query()->get();
if (count($genders) == 0) {
    \App\Model\Gender::insert([
        [
            'name' => 'Male',
        ],
        [
            'name' => 'Female',
        ],
        [
            'name' => 'Others',
        ],
    ]);
} else {
    echo "Gender data already exist<br>";
}


