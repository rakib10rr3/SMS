<?php

namespace App\Http\Controllers;

use App\Model\Group;
use App\Model\Subject;
use App\Model\TheClass;

use App\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = TheClass::all();
        //$subjects = Subject::all();

        return view('subject.index', compact( 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        $classes = TheClass::all();
        return view('subject.create', compact('classes', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //Subject::query()->create($request->all());
        $code = request('code');
        $name = request('name');
        $full_marks = request('full_marks');
        $pass_marks = request('pass_marks');

        $has_written = request('has_written');
        if($request->get('has_written') == null){
            $has_written=0;
        }
        $written_marks = request('written_marks');
        $written_pass_marks = request('written_pass_marks');

        $has_mcq = request('has_mcq');
        if($request->get('has_mcq') == null) {
            $has_mcq=0;
        }
        $mcq_marks = request('mcq_marks');
        $mcq_pass_marks = request('mcq_pass_marks');

        $has_practical = request('has_practical');
        if($request->get('has_practical') == null){
            $has_practical=0;
        }
        $practical_marks = request('practical_marks');
        $practical_pass_marks = request('practical_pass_marks');


        $class_id = request('the_class_id');
        $is_optional = request('is_optional');
        if($request->get('is_optional') == null){
            $is_optional=0;
        }
        $group_id = request('group_id');
        //return $request->all();

        $api_value = Subject::create([
            'code' => $code,
            'name' => $name,
            'full_marks' => $full_marks,
            'pass_marks' => $pass_marks,
            'has_written' => $has_written,
            'written_marks' => $written_marks,
            'written_pass_marks' => $written_pass_marks,
            'has_mcq' => $has_mcq,
            'mcq_marks' => $mcq_marks,
            'mcq_pass_marks' => $mcq_pass_marks,
            'has_practical' => $has_practical,
            'practical_marks' => $practical_marks,
            'practical_pass_marks' => $practical_pass_marks,
            'the_class_id' => $class_id,
            'is_optional' => $is_optional,
            'group_id' => $group_id,
        ]);
        return redirect('/subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $classes = TheClass::all();
        $groups = Group::all();
        return view('subject.edit', compact('subject', 'classes', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //$subject->update($request->all());
        $code = request('code');
        $name = request('name');
        $full_marks = request('full_marks');
        $pass_marks = request('pass_marks');

        $has_written = request('has_written');
        $written_marks = request('written_marks');
        $written_pass_marks = request('written_pass_marks');
        if($request->get('has_written') == null){
            $has_written=0;
            $written_marks=null;
            $written_pass_marks=null;
        }

        $has_mcq = request('has_mcq');
        $mcq_marks = request('mcq_marks');
        $mcq_pass_marks = request('mcq_pass_marks');
        if($request->get('has_mcq') == null) {
            $has_mcq=0;
            $mcq_marks=null;
            $mcq_pass_marks=null;
        }

        $has_practical = request('has_practical');
        $practical_marks = request('practical_marks');
        $practical_pass_marks = request('practical_pass_marks');
        if($request->get('has_practical') == null){
            $has_practical=0;
            $practical_marks=null;
            $practical_pass_marks=null;
        }

        $class_id = request('the_class_id');
        $is_optional = request('is_optional');
        if($request->get('is_optional') == null){
            $is_optional=0;
        }
        $group_id = request('group_id');
        //return $request->all();
        Subject::where('id', $subject->id)->update(array(
            'code' => $code,
            'name' => $name,
            'full_marks' => $full_marks,
            'pass_marks' => $pass_marks,
            'has_written' => $has_written,
            'written_marks' => $written_marks,
            'written_pass_marks' => $written_pass_marks,
            'has_mcq' => $has_mcq,
            'mcq_marks' => $mcq_marks,
            'mcq_pass_marks' => $mcq_pass_marks,
            'has_practical' => $has_practical,
            'practical_marks' => $practical_marks,
            'practical_pass_marks' => $practical_pass_marks,
            'the_class_id' => $class_id,
            'is_optional' => $is_optional,
            'group_id' => $group_id,
        ));
        return redirect('/subjects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Subject $subject
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect('/subjects');
    }

    public function getSubject(Request $request)
    {
        $classes = TheClass::all();
        $subjects = Subject::where('the_class_id', $request->class_id)->get();
        return view('subject.index', compact('subjects', 'classes'));
    }

    public function apiGetSubjectByClass($class)
    {
        $subjects = Subject::where('the_class_id',$class)->get();
        return $subjects;

    }

    public function apiGetSubjectByClassAndGroup($class, $group)
    {
        $subjects = Subject::query()
            ->where('the_class_id', $class)
            ->where('group_id', $group)->get();
        return $subjects;
    }
}
