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
        $subjects = Subject::all();
        return view('subject.index', compact('subjects','classes'));
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
        return view('subject.create',compact('classes','groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Subject::query()->create($request->all());
        return redirect('/subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $classes = TheClass::all();
        return view('subject.edit', compact('subject','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->all());
        return redirect('/subjects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect('/subjects');
    }

    public function getSubject(Request $request)
    {
        $classes = TheClass::all();
        $subjects = Subject::where('class_id', $request->class_id)->get();
        return view('subject.index', compact('subjects', 'classes'));
    }
}
