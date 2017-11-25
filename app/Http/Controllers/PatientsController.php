<?php

namespace App\Http\Controllers;

use App\MedCase;
use App\MedSmena;
use App\Contracts\SmenaAlgInterface;
use App\Contracts\WatchDogInterface;
use App\Talon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PatientsController extends Controller
{
    public function __construct(SmenaAlgInterface $alg, WatchDogInterface $watchDog)
    {
        $this->alg = $alg;
        $this->watchDog = $watchDog;
    }

    public function index()
    {
        return view('patients.index', [
          'openedSmenas' => $this->alg->calcActiveSmenas(),
          'watchDogHash' => $this->watchDog->calcHash()
        ]);
    }

    public function hash()
    {
        $hash = Input::get('hash');
        if ($this->watchDog->calcHash() == $hash) {
            return response('ok', 200)
                ->header('Content-Type', 'text/plain');
        } else {
            return response('doRedirect', 200)
                ->header('Content-Type', 'text/plain');
        }
    }

    public function getTalone(MedSmena $medsmena)
    {
        $this->watchDog->newHash();
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

    public function createMedCase($talon)
    {
        $case = new MedCase();
        $case->talon_id = $talon->id;
        $case->user_id = $talon->medSmena->user_id;
        $case->med_smena_id = $talon->med_smena_id;
        $case->status = 1;
        $case->save();
    }
}