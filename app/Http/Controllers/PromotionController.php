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
        $class_id = $request->get('the_class_id');
        $class = TheClass::find($class_id);
        $section_id = $request->get('section_id');
        $section = Section::find($section_id);
        $shift_id = $request->get('shift_id');
        $shift = Shift::find($shift_id);
        $group_id = $request->get('group_id');
        $group = Group::find($group_id);
        $session = $request->get('session');

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
                $query->where('session', $session)->with('grade')->get();
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
        return $request;


        $new_class_id = $request->get('the_class_id');
        $new_section_id = $request->get('section_id');
        $new_shift_id = $request->get('shift_id');
        $group_id = $request->get('group_id');
        $students = $request->get('student');
        $session = $request->get('session');
        foreach ($students as $key => $value) {
            Student::where('id', $key)->update([
                'the_class_id' => $new_class_id,
                'section_id' => $new_section_id,
                'shift_id' => $new_shift_id,
                'group_id' => $group_id,
                'session' => $session,
            ]);
        }
        return redirect()->route('promotion.select');
    }
}
