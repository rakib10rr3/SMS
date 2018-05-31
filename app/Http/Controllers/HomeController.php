<?php

namespace App\Http\Controllers;

use App\Model\Attendance;
use App\Model\Notice;
use App\Model\SmsHistory;
use App\Model\Staff;
use App\Model\Student;
use App\Model\Teacher;
use App\Model\TheClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::allows('access-home-stats')) {


            $all_students = Student::all()->count();
            $all_teachers = Teacher::all()->count();
            $all_staffs = Staff::all()->count();
            $notices = Notice::query()->limit(10)->orderBy('id', 'DESC')->get();

            /**
             * SELECT COUNT(*) FROM `attendances` WHERE 'created_at' > '2018-05-23 00:00:00' GROUP BY date
             */
            $today = \Carbon\Carbon::today();

            $classes = TheClass::all(['id', 'name']);

            $presents = array();

            foreach ($classes as $class) {
                $presents[$class->name] = $attendance = Attendance::query()
                    ->select('date', DB::raw('count(*) as present'))
                    ->where('the_class_id', $class->id)
                    ->where('created_at', '>', $today->subDays(7))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get()->toArray();
            }

            /**
             * Get All the dates, when one or more class has attendance
             */
            $dates = Attendance::query()
                ->select('date')
                ->distinct()
                ->orderBy('date')
                ->get()->toArray();

            foreach ($presents as $key => $value) {

                $temp_date_list = array_column($value, 'date');
                /**
                 * If specific date has no entry for a class, then it will be added as "attendance: 0".
                 */
                foreach ($dates as $date) {
                    if (array_search($date['date'], $temp_date_list) === false) {
                        $presents[$key][] = [
                            'date' => $date['date'],
                            'present' => 0
                        ];
                    }
                }

            }

            $colors = [
                '#1abc9c',
                '#2ecc71',
                '#3498db',
                '#9b59b6',
                '#34495e',
                '#f1c40f',
                '#e67e22',
                '#e74c3c',
            ];

            $color_count = 0;
            $color_total = 8;

            return view('home', compact('all_students', 'all_teachers', 'all_staffs', 'notices', 'presents', 'dates', 'colors', 'color_count', 'color_total'));

        } else {

            $not_authorized = true;
            return view('home', compact('not_authorized'));

        }

    }
}
