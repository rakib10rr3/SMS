<?php
/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 05/05/2018
 * Time: 11:13 AM
 */

use App\Model\BloodGroup;
use \App\Model\Division;
use App\Model\TheClass;
use App\Model\Section;

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

$divisions = Division::query()->get();
if (count($divisions) == 0) {
    Division::insert([
        [
            'name' => 'Dhaka',
        ],
        [
            'name' => 'Chattogram',
        ],
        [
            'name' => 'Rajshahi',
        ],
        [
            'name' => 'Khulna',
        ],
        [
            'name' => 'Barishal',
        ],
        [
            'name' => 'Sylhet',
        ],
        [
            'name' => 'Mymensingh',
        ],
        [
            'name' => 'Rangpur',
        ],
    ]);
} else {
    echo "Division data already exist<br>";
}

$shifts = \App\Model\Shift::query()->get();
if (count($shifts) == 0) {
    \App\Model\Shift::insert([
        [
            'name' => 'Morning',
        ],
        [
            'name' => 'Day',
        ],
    ]);
} else {
    echo "Shift data already exist<br>";
}

$groups = \App\Model\Group::query()->get();
if (count($groups) == 0) {
\App\Model\Group::insert([
    [
        'name' => 'Science',
    ],
    [
        'name' => 'Commerce',
    ],
    [
        'name' => 'Arts',
    ],
]);
} else {
    echo "Group data already exist<br>";
}

$classes = TheClass::query()->get();
if (count($classes) == 0) {
    TheClass::insert([
        [
            'name' => 'One',
        ],
        [
            'name' => 'Two',
        ],
        [
            'name' => 'Three',
        ],
        [
            'name' => 'Four',
        ],
        [
            'name' => 'Five',
        ],
        [
            'name' => 'Six',
        ],
        [
            'name' => 'Seven',
        ],
        [
            'name' => 'Eight',
        ],
        [
            'name' => 'Nine',
        ],
        [
            'name' => 'Ten',
        ],
    ]);
} else {
    echo "Class data already exist<br>";
}

$sections = Section::query()->get();
if (count($sections) == 0) {
    Section::insert([
        [
            'name' => 'A',
        ],
        [
            'name' => 'B',
        ],
        [
            'name' => 'C',
        ],
    ]);
} else {
    echo "Section data already exist<br>";
}

//TODO district kora lagbe
