<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/getSubjects', 'SubjectController@getSubject');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('shifts', 'ShiftController');
Route::resource('sections', 'SectionController');
Route::resource('grades', 'GradeController');
Route::resource('notices', 'NoticeController');

Route::resource('/genders','GenderController');
Route::get('/blood-groups/setup','BloodGroupController@setup')->name('blood-groups.setup');
Route::resource('/blood-groups','BloodGroupController');

Route::get('/setup', function (){
   return view('setup.setup');
});

Route::resource('/exam-terms','ExamTermController');
Route::resource('groups', 'GroupController');
Route::resource('class', 'TheClassController');
Route::resource('roles', 'RoleController');
Route::resource('teachers', 'TeacherController');

Route::resource('/students','StudentController');
Route::resource('/subjects','SubjectController');