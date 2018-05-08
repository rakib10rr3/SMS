<?php

namespace App\Http\Controllers;

use App\Model\Subject;
use App\Model\TheClass;
use App\SubjectAssign;
use App\Teacher;
use Illuminate\Http\Request;

class SubjectAssignController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$classes  = TheClass::all();
		$subjects = Subject::all();
		$teachers = Teacher::all();

		return view( 'subject_assign.index', compact( 'classes', 'subjects', 'teachers' ) );


//		foreach ( $classes as $class ) {
//			foreach ( $class->subjects as $subject ) {
//
//				foreach ( $subject->teachers as $teacher ) {
//					echo $subject->name.$teacher->name;
//				}
//
//			}
//		}


	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view( 'class.create' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		SubjectAssign::query()->create( $request->all() );
		return redirect( '/subjectAssigns' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\SubjectAssign $subjectAssign
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( SubjectAssign $subjectAssign ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\SubjectAssign $subjectAssign
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( SubjectAssign $subjectAssign ) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\SubjectAssign $subjectAssign
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, SubjectAssign $subjectAssign ) {

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\SubjectAssign $subjectAssign
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( SubjectAssign $subjectAssign ) {

	}
}
