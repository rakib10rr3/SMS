<?php

namespace App\Http\Controllers;

use App\Model\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shifts = Shift::all();
        return view('shift.index', compact('shifts'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shift.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Shift::query()->create($request->all());
        return redirect()->route('shifts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Shift  $shift
     * @return \Illuminate\Http\Response
     */
//    public function show(Shift $shift)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        return view('shift.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        $shift->update($request->all());
        return redirect()->route('shifts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Shift $shift
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();
        return redirect()->route('shifts.index');
    }
}
