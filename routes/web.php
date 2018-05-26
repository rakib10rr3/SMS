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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->name('home')
    ->middleware(['auth']);

Route::get('/setup', function () {
    return view('setup.setup');
});

Auth::routes();

Route::get('/subjects/optional', 'OptionalAssignController@index')->name('subjects.optional.index')
    ->middleware(['auth', 'can:optional-assign-crud']);
Route::post('/subjects/optional/list', 'OptionalAssignController@getData')->name('getStudentDataForSelection')
    ->middleware(['auth', 'can:optional-assign-crud']);
Route::get('/subjects/optional/assign', 'OptionalAssignController@assign')->name('assign')
    ->middleware(['auth', 'can:optional-assign-crud']);
Route::post('/subjects/optional/store', 'OptionalAssignController@store')
    ->middleware(['auth', 'can:optional-assign-crud']);
//Route::get('/subjects/optional/edit','OptionalAssignController@edit');
Route::post('/subjects/optional/edit', 'OptionalAssignController@getStudentDataWithOptionalSubject')->name('edit')
    ->middleware(['auth', 'can:optional-assign-crud']);
Route::post('/subjects/optional/update', 'OptionalAssignController@update')
    ->middleware(['auth', 'can:optional-assign-crud']);
Route::post('/subjects/optional/edit/list', 'OptionalAssignController@getStudentDataWithOptionalSubject')
    ->middleware(['auth', 'can:optional-assign-crud']);

//Route::get('/roll-generator', 'RollController@index')
//    ->middleware(['auth']);
//Route::get('/roll-generator/auto', 'RollController@autoGenerate')->name('autoRoll')
//    ->middleware(['auth']);
//Route::get('/roll-generator/merit')->name('meritRoll')
//    ->middleware(['auth']);
//Route::post('/roll-generator/auto/list', 'RollController@getAutoRollList')->name('autoRollList')
//    ->middleware(['auth']);


// TODO check it
Route::post('/getSubjects', 'SubjectController@getSubject')
    ->middleware(['auth']);


Route::resource('shifts', 'ShiftController')
    ->middleware(['auth', 'can:shift-crud']);
Route::resource('sections', 'SectionController')
    ->middleware(['auth', 'can:section-crud']);
Route::resource('grades', 'GradeController')
    ->middleware(['auth', 'can:grade-crud']);
Route::resource('notices', 'NoticeController')
    ->middleware(['auth', 'can:notice-crud']);
Route::resource('genders', 'GenderController')
    ->middleware(['auth', 'can:gender-crud']);
Route::resource('blood-groups', 'BloodGroupController')
    ->middleware(['auth', 'can:blood-group-crud']);
Route::resource('exam-terms', 'ExamTermController')
    ->middleware(['auth', 'can:exam-term-crud']);
Route::resource('groups', 'GroupController')
    ->middleware(['auth', 'can:group-crud']);
Route::resource('class', 'TheClassController')
    ->middleware(['auth', 'can:the-class-crud']);
Route::resource('roles', 'RoleController')
    ->middleware(['auth', 'can:role-crud']);
Route::resource('teachers', 'TeacherController')
    ->middleware(['auth', 'can:teacher-crud']);
Route::resource('staff', 'StaffController')
    ->middleware(['auth', 'can:staff-crud']);


Route::post('students/getStudentList', 'StudentController@getStudentList')->name('getStudentListFromStudentController')
    ->middleware(['auth', 'can:student-crud']);

Route::resource('students', 'StudentController')
    ->middleware(['auth', 'can:student-crud']);


Route::resource('subjects', 'SubjectController')
    ->middleware(['auth', 'can:subject-crud']);
// todo: api just need login
Route::get('api/subjects/{class}', 'SubjectController@apiGetSubjectByClass')->middleware(['auth']);
Route::get('api/subjects/{class}/{group}', 'SubjectController@apiGetSubjectByClassAndGroup')
    ->middleware(['auth']);


Route::get('preference', 'PreferenceController@index')->name('preference.index')
    ->middleware(['auth', 'can:preference-crud']);
Route::put('preference', 'PreferenceController@update')->name('preference.update')
    ->middleware(['auth', 'can:preference-crud']);


//Route::resource('subjectAssigns', 'SubjectAssignController')
//    ->middleware(['auth']);

// todo -_-
Route::resource('classAssigns', 'ClassAssignController')
    ->middleware(['auth']);


Route::get('send-sms/select', 'SendSmsController@select')->name('sendSms.select')
    ->middleware(['auth', 'can:sms-send']);
Route::post('send-sms/create', 'SendSmsController@create')->name('sendSms.create')
    ->middleware(['auth', 'can:sms-send']);
Route::post('send-sms/show', 'SendSmsController@store')->name('sendSms.store');
Route::get('send-sms/balance', 'SendSmsController@balance')->name('sendSms.balance')
    ->middleware(['auth', 'can:sms-send']);


Route::get('sms-history', 'SmsHistoryController@index')->name('smsHistory.index')
    ->middleware(['auth', 'can:sms-history']);
Route::post('sms-history', 'SmsHistoryController@store')->name('smsHistory.store')
    ->middleware(['auth', 'can:sms-history']);


//Route::resource('/attendances','AttendanceController');
Route::get('attendances/select', 'AttendanceController@select')->name('attendance.select')
    ->middleware(['auth', 'can:attendance-crud']);
Route::post('attendances/create', 'AttendanceController@create')->name('attendance.create')
    ->middleware(['auth', 'can:attendance-crud']);
Route::post('attendances/store', 'AttendanceController@store')->name('attendance.store')
    ->middleware(['auth', 'can:attendance-crud']);


Route::get('marks/add', 'MarkController@query')->name('marks.add.query')
    ->middleware(['auth', 'can:mark-crud']);
Route::post('marks/add', 'MarkController@add')->name('marks.add.add')
    ->middleware(['auth', 'can:mark-crud']);
Route::put('marks/add', 'MarkController@store')->name('marks.add.store')
    ->middleware(['auth', 'can:mark-crud']);
Route::get('marks/show', 'MarkController@showQuery')->name('marks.show.query')
    ->middleware(['auth', 'can:mark-crud']);
Route::post('marks/show', 'MarkController@show')->name('marks.show')
    ->middleware(['auth', 'can:mark-crud']);
Route::post('marks/update', 'MarkController@updateAdd')->name('marks.update.add')
    ->middleware(['auth', 'can:mark-crud']);
Route::patch('marks/update', 'MarkController@update')->name('marks.update')
    ->middleware(['auth', 'can:mark-crud']);


Route::get('merit-list', 'MeritListController@index')->name('meritList.index')
    ->middleware(['auth', 'can:merit-list-crud']);
Route::post('merit-list', 'MeritListController@show')->name('meritList.show')
    ->middleware(['auth', 'can:merit-list-crud']);
//Route::put('merit-list', 'MeritListController@update')->name('meritList.update')
//    ->middleware(['auth', 'can:merit-list-crud']);

//Route::get('merit-list/final', 'MeritListController@finalIndex')->name('meritList.final.index')
//    ->middleware(['auth', 'can:merit-list-crud']);
//Route::post('merit-list/final', 'MeritListController@finalShow')->name('meritList.final.show')
//    ->middleware(['auth', 'can:merit-list-crud']);

// todo: show_for_edit
Route::post('attendances/edit', 'AttendanceController@showForEdit')->name('attendance.showForEdit')
    ->middleware(['auth', 'can:attendance-crud']);
Route::get('attendances/edit', 'AttendanceController@edit')->name('attendance.edit')
    ->middleware(['auth', 'can:attendance-crud']);
Route::post('attendances/update', 'AttendanceController@update')->name('attendance.update')
    ->middleware(['auth', 'can:attendance-crud']);
// todo: select_for_view
Route::get('attendances/show', 'AttendanceController@selectForView')->name('attendance.selectForView')
    ->middleware(['auth', 'can:attendance-crud']);
Route::post('attendances/show', 'AttendanceController@show')->name('attendance.show')
    ->middleware(['auth', 'can:attendance-crud']);


Route::get('promotion', 'PromotionController@select')->name('promotion.select')
    ->middleware(['auth', 'can:promotion-crud']);
Route::post('promotion', 'PromotionController@view')->name('promotion.view')
    ->middleware(['auth', 'can:promotion-crud']);
Route::post('promotion/update', 'PromotionController@update')->name('promotion.update')
    ->middleware(['auth', 'can:promotion-crud']);
