<?php
/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 05/05/2018
 * Time: 11:13 AM
 */

use App\Model\Grade;
use App\Model\Role;
use App\Model\Section;
use App\Model\ExamTerm;
use App\Model\TheClass;
use \App\Model\Division;
use App\Model\BloodGroup;
use App\Model\Preference;
use App\User;

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
            'name' => 'None',
        ],
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

$exam_terms = ExamTerm::query()->get();
if (count($exam_terms) == 0) {
    ExamTerm::insert([
        [
            'name' => 'First Term',
        ],
        [
            'name' => 'Second Term',
        ],
        [
            'name' => 'Final Term',
        ],
    ]);
} else {
    echo "Exam Term data already exist<br>";
}


$preferences = Preference::query()->get();
if (count($preferences) == 0) {
    Preference::insert([
        [
            'key' => 'institute_name',
            'value' => 'Institute Name'
        ],
        [
            'key' => 'founded_year',
            'value' => 'Founded Year'
        ],
        [
            'key' => 'phone_number_1',
            'value' => '0123456789'
        ],
        [
            'key' => 'phone_number_2',
            'value' => '0123456789'
        ],
        [
            'key' => 'phone_number_3',
            'value' => '0123456789'
        ],
        [
            'key' => 'address',
            'value' => 'Your Address'
        ],

        [
            'key' => 'teacher_id_counter',
            'value' => '0'
        ],
        [
            'key' => 'staff_id_counter',
            'value' => '0'
        ],
        [
            'key' => 'student_id_counter',
            'value' => '0'
        ],
    ]);
} else {
    echo "Preference data already exist<br>";
}

/*
http://www.educationboard.gov.bd/grads.htm

Class Interval 	Letter grade 	grade Point
80-100 	        A+ 	            5
70-79       	A           	4
60-69       	A-          	3.5
50-59       	B           	3
40-49       	C           	2
33-39       	D           	1
0-32        	F           	0
*/

/**
 * Todo: if you change this change also in "Mark" views
 */

$grades = Grade::query()->get();
if (count($grades) == 0) {
    Grade::insert([
        [
            'name' => 'A+',
            'min_point' => '005.00',
            'max_point' => '005.00',
            'min_value' => '80',
            'max_value' => '100'
        ],
        [
            'name' => 'A',
            'min_point' => '004.00',
            'max_point' => '004.99',
            'min_value' => '70',
            'max_value' => '79'
        ],
        [
            'name' => 'A-',
            'min_point' => '03.50',
            'max_point' => '03.99',
            'min_value' => '60',
            'max_value' => '69'
        ],
        [
            'name' => 'B',
            'min_point' => '003.00',
            'max_point' => '003.49',
            'min_value' => '50',
            'max_value' => '59'
        ],
        [
            'name' => 'C',
            'min_point' => '002.00',
            'max_point' => '002.99',
            'min_value' => '40',
            'max_value' => '49'
        ],
        [
            'name' => 'D',
            'min_point' => '001.00',
            'max_point' => '001.99',
            'min_value' => '33',
            'max_value' => '39'
        ],
        [
            'name' => 'F',
            'min_point' => '000.00',
            'max_point' => '000.99',
            'min_value' => '0',
            'max_value' => '32'
        ],
    ]);
} else {
    echo "grade data already exist<br>";
}

// ========================

$grades = Role::query()->get();
if (count($grades) == 0) {
    Role::insert([
        [
            'name' => 'Student'
        ],
        [
            'name' => 'Teacher'
        ],
        [
            'name' => 'Staff'
        ],
        [
            'name' => 'Admin'
        ],
        [
            'name' => 'KDA IT'
        ]
    ]);
} else {
    echo "role data already exist<br>";
}

// ========================

$user = User::query()->where('username', 'kdait')->get();
if (count($user) == 0) {
    $user = new User;
    $user->username = 'kdait';
    $user->password = bcrypt('password');
    $user->role_id = 5;
    $user->save();
} else {
    echo "Super User already exist<br>";
}

$user = User::query()->where('username', 'admin')->get();
if (count($user) == 0) {
    $user = new User;
    $user->username = 'admin';
    $user->password = bcrypt('password');
    $user->role_id = 4;
    $user->save();
} else {
    echo "Default User already exist<br>";
}