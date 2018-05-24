<?php

namespace App\Http\Controllers;

use App\Model\Notice;
use App\Model\SmsHistory;
use App\Model\Staff;
use App\Model\Student;
use App\Model\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**web
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $all_students = Student::all()->count();
        $all_teachers = Teacher::all()->count();
        $all_staffs = Staff::all()->count();
        $all_notices = Notice::all();

        //echo  $all_students ." ".$all_teachers." ".$all_staffs;

        return view('home', compact('all_students', 'all_teachers', 'all_staffs', 'all_notices'));
    }
}
