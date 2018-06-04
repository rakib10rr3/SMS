<?php

namespace App\Http\Controllers;

use App\Model\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        $success = false;
        return view('group.index', compact('groups', 'success'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $success = false;
        return view('group.create', compact('success'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        $customMessages = [
            'name.required' => 'Group Name is required',
        ];

        $this->validate($request, $rules, $customMessages);


        Group::query()->create($request->all());
        return redirect('/groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Group $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Model\Group $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $group = Group::query()->find($group);
        $success = false;
        return view('group.edit', compact('group', compact('success')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $group->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Group $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //return $group;
        $group->delete();

    }

    public function tesla(Request $request)
    {
        return $request;
    }

    public function customEdit(Request $request)
    {

        $group_id = $request->get('id');
        $group = Group::find($group_id);
        $group->name = $request->get('name');
        $group->save();
        return $group;
    }
}
