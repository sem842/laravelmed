<?php

namespace App\Http\Controllers;

use App\MedService;
use App\MedSmena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class MedSmenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medServices = Auth::user()->group->medServices;
        $openedSmenas = $this->calcOpenedSmenas($medServices);
        $possibleMedServices = $this->calcPossibleMedServices($medServices, $openedSmenas);

        return view('medsmenas.indextwo', [
            'openSmenas' => $openedSmenas,
            'possibleMedServices' => $possibleMedServices,
            'allSmenas' => MedSmena::all(),
        ]);
    }

    private function calcOpenedSmenas($medServices)
    {
        /* Old method */
        /*$ids = [];
        foreach ($medServices as $medService) {
            $ids[] = $medService->id;
        }*/

        /* fresh method */
        $ids = $medServices->map(function($value, $index){
            return $value->id;
        });
        return MedSmena::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 1],
            //['med_service_id', $ids]
        ])->get();
    }

    private function calcPossibleMedServices($medServices, $openedSmenas)
    {
        $ids = $openedSmenas->map(function($value, $index){
            return $value->med_service_id;
        });
        return $medServices->whereNotIn('id', $ids);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medsmenas.create', [
            'medservices' => Auth::user()->group->medServices
        ]);
    }

    public function createWithService(MedService $medservice)
    {
        return view('medsmenas.createtwo', [
            'medservice' => $medservice,
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
            $id = Input::get('med_service_id');
            return Redirect::to('medsmenas/'.$id.'/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $medSmena = new MedSmena;
            $medSmena->med_service_id = Input::get('med_service_id');
            $medSmena->patients_plan = Input::get('patients_plan');

            $medSmena->user_id = Auth::user()->id;
            $medSmena->started = date('Y-m-d H:i:s');
            $medSmena->stopped = date('Y-m-d H:i:s');
            $medSmena->status = 1; //Open
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
    public function edit(MedSmena $medsmena)
    {
        return View::make('medsmenas.edit', [
            'medSmena' => $medsmena
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedSmena  $medSmena
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedSmena $medsmena)
    {
        $medsmena->status = 2; //Close
        $medsmena->stopped = date('Y-m-d H:i:s');
        $medsmena->save();
        Session::flash('message', Lang::get('t.med_smena_close_success'));
        return Redirect::to('medsmenas');
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
