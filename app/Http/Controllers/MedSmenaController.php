<?php

namespace App\Http\Controllers;

use App\MedSmena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MedSmenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('medsmenas.index', [
            'allSmenas' => MedSmena::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medsmenas.create', [
            //'medservices' => Auth::user()->group->medServices
            'medservices' => Auth::user()->group->medServices
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'med_service_id' => 'required|integer',
            'patients_plan' => 'required|integer',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('medsmenas/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $medSmena = new MedSmena;
            $medSmena->user_id = Auth::user()->id;
            $medSmena->med_service_id = Input::get('med_service_id');
            $medSmena->patients_plan = Input::get('patients_plan');
            $medSmena->started = date('Y-m-d H:i:s') ;
            $medSmena->stopped = date('Y-m-d H:i:s') ;
            $medSmena->status = 1;
            $medSmena->save();
            Session::flash('message', Lang::get('t.med_smena_create_success'));
            return Redirect::to('medsmenas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedSmena  $medSmena
     * @return \Illuminate\Http\Response
     */
    public function show(MedSmena $medsmena)
    {
        return view('medsmenas.show', [
            'medSmena' => $medsmena,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedSmena  $medSmena
     * @return \Illuminate\Http\Response
     */
    public function edit(MedSmena $medSmena)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedSmena  $medSmena
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedSmena $medSmena)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedSmena  $medSmena
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedSmena $medSmena)
    {
        //
    }
}
