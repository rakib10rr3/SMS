<?php

namespace App\Http\Controllers;

use App\Model\ClassAssign;
use App\Model\Section;
use App\Model\Subject;
use App\Model\TheClass;
use App\Teacher;
use Illuminate\Http\Request;

class ClassAssignController extends Controller
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
        $teachers = Teacher::all();
        $sections = Section::all();
        $classAssigns = ClassAssign::all();
        return view('class_assign.index', compact('classes', 'subjects', 'teachers', 'sections','classAssigns'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = TheClass::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $sections = Section::all();

        return view('class_assign.create', compact('classes', 'subjects', 'teachers', 'sections', 'classAssigns'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stores = ClassAssign::query()->create($request->all());
        return redirect('/classAssigns');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ClassAssign $classAssign
     * @return \Illuminate\Http\Response
     */
    public function show(ClassAssign $classAssign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ClassAssign $classAssign
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassAssign $classAssign)
    {
        $classes = TheClass::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $sections = Section::all();
        $classAssign = ClassAssign::query()->find($classAssign)->first();
        return view('class_assign.edit', compact('classes', 'subjects', 'teachers', 'sections','classAssign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\ClassAssign $classAssign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassAssign $classAssign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ClassAssign $classAssign
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassAssign $classAssign)
    {
        //
    }
}
