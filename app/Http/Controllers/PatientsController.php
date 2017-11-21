<?php

namespace App\Http\Controllers;

use App\MedCase;
use App\MedSmena;
use App\Contracts\ISmenaAlg;
use App\Talon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PatientsController extends Controller
{
    public function __construct(ISmenaAlg $alg)
    {
        $this->alg = $alg;
    }

    public function index()
    {
        return view('patients.index', [
          'openedSmenas' => $this->alg->calcActiveSmenas()
        ]);
    }

    protected function getTalone(MedSmena $medsmena)
    {
        $this->alg->setSmena($medsmena);

        if ($this->alg->isAvailableTalon()){
            $talon = new Talon();
            $talon->med_smena_id = $medsmena->id;
            $talon->name = $this->alg->generateTalonName();
            $talon->save();
            if ($talon->save()) {
                $this->createMedCase($talon);
            };
            Session::flash("message", "Талон " . $talon->name . " выдан");
        } else {
            Session::flash("error-message", "Превышен план");
        }
        return Redirect::to('patients');
    }

    protected function createMedCase($talon)
    {
        $case = new MedCase();
        $case->talon_id = $talon->id;
        $case->user_id = $talon->medSmena->user_id;
        $case->med_smena_id = $talon->med_smena_id;
        $case->status = 1;
        $case->save();
    }
}