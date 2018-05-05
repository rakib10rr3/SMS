<?php

namespace App\Http\Controllers;

use App\Model\ExamTerm;
use Illuminate\Http\Request;

class ExamTermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examTerms = ExamTerm::query()->get();
        return view('exam_term.index', compact('examTerms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exam_term.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|',
        ]);
        ExamTerm::query()->create($request->all());
        return redirect('/exam-terms');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ExamTerm $examTerm
     * @return \Illuminate\Http\Response
     */
    public function show(ExamTerm $examTerm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ExamTerm $examTerm
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamTerm $examTerm)
    {
        return view('exam_term.edit', compact('examTerm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\ExamTerm $examTerm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamTerm $examTerm)
    {
        $examTerm->update($request->all());
        return redirect('/exam-terms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ExamTerm $examTerm
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamTerm $examTerm)
    {
        $examTerm->delete();
        return redirect('/exam-terms');
    }
}
