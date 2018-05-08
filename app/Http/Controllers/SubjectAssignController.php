<?php

namespace App\Http\Controllers;

use App\SubjectAssign;
use Illuminate\Http\Request;

class SubjectAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = TheClass::all();
        return view('class.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',

        ]);

        TheClass::query()->create($request->all());
        return redirect('/class');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubjectAssign  $subjectAssign
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectAssign $subjectAssign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubjectAssign  $subjectAssign
     * @return \Illuminate\Http\Response
     */
    public function edit(SubjectAssign $subjectAssign)
    {

        $class = TheClass::query()->find($class);
        return view('class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubjectAssign  $subjectAssign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubjectAssign $subjectAssign)
    {
        $class->update($request->all());
        return redirect('/class');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubjectAssign  $subjectAssign
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubjectAssign $subjectAssign)
    {
        $theclasses = TheClass::where("id", $id)->first();
        $theclasses->delete();
        return redirect('/class');
    }
}
