<?php

namespace App\Http\Controllers;

use App\Model\Group;
use App\Model\MeritList;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\TheClass;
use function foo\func;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    //
    //1
    public function select()
    {
        $classes = TheClass::all();
        $sections = Section::all();
        $shifts = Shift::all();
        $groups = Group::all();
        $come = 1;

        return view('promotion.select', compact('classes', 'sections', 'shifts', 'groups', 'come'));
    }

    public function view(Request $request)
    {
        $query = $request->except('_token');

        $class_id = $request->get('the_class_id');
        $class = TheClass::query()->find($class_id);

        $section_id = $request->get('section_id');
        $section = Section::query()->find($section_id);

        $shift_id = $request->get('shift_id');
        $shift = Shift::query()->find($shift_id);

        $group_id = $request->get('group_id');
        $group = Group::query()->find($group_id);

        $session = $request->get('session');

        //dd($request);

        /*
               "the_class_id" => "2"
      "shift_id" => "1"
      "section_id" => "1"
      "group_id" => "1"
      "session" => "2018"
         */

        $merit_list_count = MeritList::query()
            ->select('the_class_id')
            ->where('section_id', $section_id)
            ->where('shift_id', $shift_id)
            ->where('session', $session)
            ->where('exam_term_id', 3)
            ->distinct()
            ->get();

        $total_class = TheClass::query()->count();

        /**
         * Check if all class final term result published
         */
        if (count($merit_list_count) != $total_class) {
            $classes = TheClass::all();
            $sections = Section::all();
            $shifts = Shift::all();
            $groups = Group::all();
            $come = 1;

            $error_message = "Final Term Result of All Classes Not Published Yet!";

            return view('promotion.select', compact('classes', 'sections', 'shifts', 'groups', 'come', 'error_message', 'query'));
        }

        $groups = Group::all();
        $classes = TheClass::all();
        $sections = Section::all();
        $shifts = Shift::all();

        $come = 2;

        /**
         * HELP:
         * https://laravel.com/docs/4.2/eloquent at "Eager Load Constraints"
         */
        $students = Student::with(array(
            'meritLists' => function ($query) use ($session) {
                $query->where('session', $session)
                    ->where('exam_term_id', 3)
                    ->with('grade')->get();
            }
        ))
            ->where('the_class_id', $class_id)
            ->where('shift_id', $shift_id)
            ->where('section_id', $section_id)
            ->where('group_id', $group_id)
            ->get();

        return view('promotion.select', compact('students', 'come', 'classes', 'sections', 'shifts', 'groups', 'class', 'section', 'shift', 'group', 'session'));
    }

    public function update(Request $request)
    {
//        return $request->all();
//        dd($request->get('to_inactive'));

        $new_class_id = $request->get('the_class_id');
        $new_section_id = $request->get('section_id');
        $new_shift_id = $request->get('shift_id');
        $group_id = $request->get('group_id');
        $students = $request->get('student');
        $session = $request->get('session');
        $to_inactive = $request->get('to_inactive');


        foreach ($students as $key => $value) {
            if ($value == "yes") {
                if (empty($to_inactive)) {
                    Student::query()
                        ->where('id', $key)
                        ->update([
                            'the_class_id' => $new_class_id,
                            'section_id' => $new_section_id,
                            'shift_id' => $new_shift_id,
                            'group_id' => $group_id,
                            'session' => $session,
                        ]);
                } else {
                    Student::query()
                        ->where('id', $key)
                        ->update([
                            'is_active' => false,
                        ]);
                }

            } else {
                Student::query()
                    ->where('id', $key)
                    ->update([
                        'session' => $session,
                    ]);
            }
        }

        /**
         * Help:
         * https://laravel.com/docs/5.6/redirects#redirecting-with-flashed-session-data
         */
        return redirect()->route('promotion.select')->with('status', 'Students Successfully Promoted!');
    }
}
