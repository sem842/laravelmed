<?php

namespace App\Http\Controllers;

use App\Group;
use App\MedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class MedServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medService = MedService::all();
        return View::make('medservices.index', [
            'medService' => $medService
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        return View::make('medservices.create', [
            'groups' => $groups
        ]);
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
            'name' => 'required|unique:med_services',
            'group_id' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('medservices/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $medServices = new MedService();
            $medServices->name = Input::get('name');
            $medServices->group_id = Input::get('group_id');
            $medServices->save();
            Session::flash('message', Lang::get('t.med_services_create_success'));
            return Redirect::to('medservices');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedService $medService
     * @return \Illuminate\Http\Response
     */
    public function show(MedService $medService)
    {
        return view('medservices.show', [
            'medService' => $medService,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedService $medService
     * @return \Illuminate\Http\Response
     */
    public function edit(MedService $medService)
    {
        return View::make('medservices.edit', [
            'medService' => $medService,
            'groups' => Group::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\MedService $medService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedService $medService)
    {
        $rules = [
            'name' => 'required'
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('medservices/' . $medService->id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $medService->name = Input::get('name');
            $medService->group_id = Input::get('group_id');
            $medService->save();
            Session::flash('message', Lang::get('t.med_services_update_success'));
            return Redirect::to('medservices');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedService $medService
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedService $medService)
    {
        if ($medService->canDestroy()) {
            $medService->delete();
            Session::flash('message', Lang::get('t.med_services_delete_success'));
        } else {
            Session::flash('error-message', Lang::get('t.med_services_delete_fail'));
        }
        return Redirect::to('medservices');
    }
}
