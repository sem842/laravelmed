<?php

namespace App\Http\Controllers;

use App\MedSmena;
use App\Talon;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $openedSmenas = MedSmena::where('status', 1)->get();
        return view('patients.index', [
          'openedSmenas' => $openedSmenas,
        ]);
    }

    protected function getTalone(MedSmena $medsmena)
    {
        //var_dump($medsmena);
        if ($medsmena->patients_plan > $medsmena->talons->count()){
            echo 'Hi!';
            $talon = new Talon();
            $talon->med_smena_id = $medsmena->id;
            $talon->name = $this->generateName();
            var_dump($talon->name);die;
        }
    }

    protected function generateName(){
        return 'talonNumber';
    }
}
