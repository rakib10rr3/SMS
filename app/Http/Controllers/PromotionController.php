<?php

namespace App\Http\Controllers;

use App\Model\Group;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\TheClass;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    //
    //1
    public function select(){
        $classes = TheClass::all();
        $sections = Section::all();
        $shifts = Shift::all();
        $groups = Group::all();
        $come = 1;

        return view('promotion.select',compact('classes','sections','shifts','groups','come'));
    }

    public function view(Request $request){

        $class_id = $request->get('the_class_id');
        $class = TheClass::find($class_id);
        $section_id = $request->get('section_id');
        $section = Section::find($section_id);
        $shift_id = $request->get('shift_id');
        $shift = Shift::find($shift_id);
        $group_id = $request->get('group_id');
        $group = Group::find($group_id);

        $groups = Group::all();
        $classes = TheClass::all();
        $sections = Section::all();
        $shifts = Shift::all();

        $come = 2;
        $students = Student::where('the_class_id', $class_id )->where('shift_id',$shift_id)->where('section_id',$section_id)->where('group_id',$group_id)->get();
       // return compact('class','shift','group','section');
        return view('promotion.select',compact('students','come','classes','sections','shifts','groups','class','section','shift','group'));
    }

    public function update(Request $request){

        $new_class_id = $request->get('the_class_id');
        $new_section_id = $request->get('section_id');
        $new_shift_id = $request->get('shift_id');
        $group_id = $request->get('group_id');
        $students = $request->get('student');
        foreach ($students as $key=>$value){
            Student::where('id',$key)->update([
                'the_class_id'=>$new_class_id,
                'section_id'=>$new_section_id,
                'shift_id'=>$new_shift_id,
                'group_id'=>$group_id
            ]);
        }
        return redirect('promotion/select');
    }
}
