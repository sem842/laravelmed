<?php

namespace App\Http\Controllers;

use App\MedCase;
use App\MedSmena;
use App\Talon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PatientsController extends Controller
{
    public function index()
    {
        return view('patients.index', [
          'openedSmenas' => $this->calcOpenedSmenas()
        ]);
    }

    protected function calcOpenedSmenas()
    {
        return MedSmena::where('status', 1)->get();
    }

    protected function getTalone(MedSmena $medsmena)
    {
        $talonsCount = $medsmena->talons->count();
        if ($medsmena->patients_plan > $talonsCount){
            $talon = new Talon();
            $talon->med_smena_id = $medsmena->id;
            $talon->name = $this->generateName(
                $medsmena->medService->group->name,
                $talonsCount
            );
            if ($talon->save()) {
                $this->createMedCase($talon);
            };
            Session::flash("message", "Талон " . $talon->name . " выдан");
        } else {
            Session::flash("error-message", "Превышен план");
        }
        return Redirect::to('patients');
    }

    protected function generateName($groupName, $counter){
        $result = "0000";
        $c = $counter + 1;
        $talonsMap = [
            'Cardio' => 'C',
            'Doctor' => 'D',
        ];
        if (array_key_exists($groupName, $talonsMap)) {
            $result[0] = $talonsMap[$groupName];
        } else {
            $result[0] = "U"; //Unknown
        }
        $result = substr($result, 0, -(strlen($c)));
        $result .= $c;
        return $result;
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