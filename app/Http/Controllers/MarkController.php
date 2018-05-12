<?php

namespace App\Http\Controllers;

use App\Model\Mark;
use App\Model\Shift;
use App\Model\Section;
use App\Model\Subject;
use App\Model\ExamTerm;
use App\Model\TheClass;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Add Marks
     */
    public function add()
    {
        $classes = TheClass::all();
        $sections = Section::all();
        $shifts = Shift::all();
        $exam_terms = ExamTerm::all();
        $subjects = Subject::where('the_class_id', 1)->get();

        return view('mark.index', compact('classes', 'sections', 'shifts', 'exam_terms', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = $request->except(['_token', 'DataTables_Table_0_length']);

        // dd($query);

/*
    "_token" => "eqbC62WzmrdZBowWmahZd8qPjyvaFqYSdqtfmPGC"
    "theclass" => "1"
    "section" => "10"
    "shift" => "1"
    "session" => "2018"
    "subject" => "5"
    "exam_term" => "1"
    */
        $the_class = $query['theclass'];    

        $classes = TheClass::all();
        $sections = Section::all();
        $shifts = Shift::all();
        $exam_terms = ExamTerm::all();
        $subjects = Subject::where('the_class_id', $the_class)->get();

        return view('mark.index', compact('classes', 'sections', 'shifts', 'exam_terms', 'subjects', 'query'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        //
    }
}
