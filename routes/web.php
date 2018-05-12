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

use App\Model\TheClass;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/subjects/optional','OptionalAssignController@index');
Route::post('/subjects/optional/list','OptionalAssignController@getData');
Route::post('/subjects/optional/store','OptionalAssignController@store');
Route::get('/subjects/optional/edit','OptionalAssignController@edit');
Route::post('/subjects/optional/edit/list','OptionalAssignController@getStudentDataWithOptionalSubject');
Route::post('/subjects/optional/update','OptionalAssignController@update');

Route::post('/getSubjects', 'SubjectController@getSubject');
Route::resource('shifts', 'ShiftController');
Route::resource('sections', 'SectionController');
Route::resource('grades', 'GradeController');
Route::resource('notices', 'NoticeController');

Route::resource('/genders', 'GenderController');
Route::get('/blood-groups/setup', 'BloodGroupController@setup')->name('blood-groups.setup');
Route::resource('/blood-groups', 'BloodGroupController');

Route::get('/setup', function () {
    return view('setup.setup');
});

Route::resource('/exam-terms', 'ExamTermController');
Route::resource('groups', 'GroupController');
Route::resource('class', 'TheClassController');
Route::resource('roles', 'RoleController');
Route::resource('teachers', 'TeacherController');

Route::get('preference', 'PreferenceController@index')->name('preference.index')->middleware('auth');
Route::put('preference', 'PreferenceController@update')->name('preference.update')->middleware('auth');
Route::resource('/students', 'StudentController');
Route::resource('/subjects', 'SubjectController');
Route::resource('/subjectAssigns', 'SubjectAssignController');
Route::resource('/classAssigns', 'ClassAssignController');

Route::get('api/dropdown', function(){
    $id = Input::get('option');
    $models = TheClass::find($id)->subjects;
    return $models;
});


//Route::resource('/attendances','AttendanceController');
Route::get('/attendances/select','AttendanceController@select')->name('attendance.select');
Route::post('/attendances/create','AttendanceController@create')->name('attendance.create');
Route::post('/attendances/show','AttendanceController@store')->name('attendance.store');

Route::get('/generate-roll','RollController@index');
Route::get('generate-roll/auto','RollController@autoGenerate')->name('autoRoll');
Route::get('generate-roll/merit','RollController@meritGenerate')->name('meritRoll');