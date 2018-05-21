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
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/subjects/optional','OptionalAssignController@index');
Route::post('/subjects/optional/list','OptionalAssignController@getData')->name('getStudentDataForSelection');
Route::get('/subjects/optional/assign','OptionalAssignController@assign')->name('assign');
Route::post('/subjects/optional/store','OptionalAssignController@store');
//Route::get('/subjects/optional/edit','OptionalAssignController@edit');
Route::post('/subjects/optional/edit','OptionalAssignController@getStudentDataWithOptionalSubject')->name('edit');
Route::post('/subjects/optional/update','OptionalAssignController@update');
Route::post('/subjects/optional/edit/list', 'OptionalAssignController@getStudentDataWithOptionalSubject');

Route::get('/roll-generator', 'RollController@index');
Route::get('/roll-generator/auto', 'RollController@autoGenerate')->name('autoRoll');
Route::get('/roll-generator/merit')->name('meritRoll');
Route::post('/roll-generator/auto/list', 'RollController@getAutoRollList')->name('autoRollList');

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
Route::resource('/groups', 'GroupController');

//Route::Post('/Tesla/test','GroupController@tesla');

Route::resource('class', 'TheClassController');
Route::resource('roles', 'RoleController');
Route::resource('teachers', 'TeacherController');

Route::post('/students/getStudentList','StudentController@getStudentList')->name('getStudentListFromStudentController');
Route::resource('/students', 'StudentController');
Route::resource('/subjects', 'SubjectController');
Route::get('preference', 'PreferenceController@index')->name('preference.index')->middleware('auth');
Route::put('preference', 'PreferenceController@update')->name('preference.update')->middleware('auth');
Route::resource('/students', 'StudentController');
Route::resource('/subjects', 'SubjectController');
Route::resource('/subjectAssigns', 'SubjectAssignController');
Route::resource('/classAssigns', 'ClassAssignController');

Route::get('/sendSms/select', 'SendSmsController@select')->name('sendSms.select');
Route::post('/sendSms/create', 'SendSmsController@create')->name('sendSms.create');
Route::post('/sendSms/show', 'SendSmsController@store')->name('sendSms.store');
Route::get('/sendSms/select', 'SendSmsController@select')->name('sendSms.select');
Route::post('/sendSms/create', 'SendSmsController@create')->name('sendSms.create');
Route::post('/sendSms/show', 'SendSmsController@store')->name('sendSms.store');


Route::get('api/subjects/{id}', function ($id) {
    $subjects = TheClass::find($id)->subjects;
    return $subjects;
});

Route::get('api/subjects/{class}/{group}', function ($class, $group) {
    $subjects = \App\Model\Subject::query()
        ->where('the_class_id', $class)
        ->where('group_id', $group)->get();
    return $subjects;
});

//Route::resource('/attendances','AttendanceController');
Route::get('/attendances/select', 'AttendanceController@select')->name('attendance.select');
Route::post('/attendances/create', 'AttendanceController@create')->name('attendance.create');
Route::post('/attendances/store', 'AttendanceController@store')->name('attendance.store');

Route::get('/marks/add', 'MarkController@query')->name('marks.add.query')->middleware('auth');
Route::post('/marks/add', 'MarkController@add')->name('marks.add.add')->middleware('auth');
Route::put('/marks/add', 'MarkController@store')->name('marks.add.store')->middleware('auth');
Route::get('/marks/show', 'MarkController@showQuery')->name('marks.show.query')->middleware('auth');
Route::post('/marks/show', 'MarkController@show')->name('marks.show')->middleware('auth');
Route::post('/marks/update', 'MarkController@updateAdd')->name('marks.update.add')->middleware('auth');
Route::patch('/marks/update', 'MarkController@update')->name('marks.update')->middleware('auth');

Route::post('/attendances/show_for_edit', 'AttendanceController@showForEdit')->name('attendance.showForEdit');
Route::get('/attendances/edit', 'AttendanceController@edit')->name('attendance.edit');
Route::post('/attendances/update', 'AttendanceController@update')->name('attendance.update');
Route::get('/attendances/select_for_view', 'AttendanceController@selectForView')->name('attendance.selectForView');
Route::post('/attendances/show', 'AttendanceController@show')->name('attendance.show');

Route::post('/attendances/show_for_edit','AttendanceController@showForEdit')->name('attendance.showForEdit');
Route::get('/attendances/edit','AttendanceController@edit')->name('attendance.edit');
Route::post('/attendances/update','AttendanceController@update')->name('attendance.update');
Route::get('/attendances/select_for_view','AttendanceController@selectForView')->name('attendance.selectForView');
Route::post('/attendances/show','AttendanceController@show')->name('attendance.show');
Route::get('promotion/select','PromotionController@select')->name('promotion.select');
Route::post('promotion/select','PromotionController@view')->name('promotion.view');
Route::post('promotion/update','PromotionController@update')->name('promotion.update');

Route::get('/merit-list', 'MeritListController@index')->name('meritList.index')->middleware('auth');
Route::post('/merit-list', 'MeritListController@show')->name('meritList.show')->middleware('auth');
Route::put('/merit-list', 'MeritListController@update')->name('meritList.update')->middleware('auth');


Route::get('/Sms-History', 'SmsHistoryController@index')->name('smsHistory.index');
Route::post('/Sms-History', 'SmsHistoryController@store')->name('smsHistory.store');