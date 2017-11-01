<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

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
        return View::make('groups.index', [
            'groups' => $groups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('groups.create');
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
            'name' => 'required|unique:groups',
            'description' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('groups/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $group = new Group();
            $group->name = Input::get('name');
            $group->description = Input::get('description');
            $group->save();
            Session::flash('message', Lang::get('t.success_group_created'));
            return Redirect::to('groups');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return View::make('groups.show', [
            'group' => $group
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return View::make('groups.edit', [
            'group' => $group
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('groups/' . $group->id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $group->name = Input::get('name');
            $group->description = Input::get('description');
            $group->save();
            Session::flash('message', Lang::get('t.success_group_updated'));
            return Redirect::to('groups');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        if ($group->canDestroy()) {
            $group->delete();
            Session::flash('message', 'Successfully deleted!');
        } else {
            Session::flash('error-message', 'Fail to delete group');
        }
        return Redirect::to('groups');
    }

    public function manage()
    {
        return view('groups.manage', [
            'groups' => Group::All(),
            'users' => User::All()
        ]);
    }

    public function assign()
    {
        $user_id = Input::get('user_id');
        $group_id = Input::get('group_id');

        $user = User::find($user_id);
        $group = Group::find($group_id);

        if ($user && $group) {
            $user->group_id = $group_id;
            $user->save();
            Session::flash('message', "Successfully assigned group!");
        } else {
            Session::flash('error-message', "Fail to assign group!");
        }
        return Redirect::to('groups/manage');
    }
}