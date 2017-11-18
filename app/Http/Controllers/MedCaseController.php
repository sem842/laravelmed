<?php

namespace App\Http\Controllers;

use App\MedCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MedCaseController extends Controller
{
    public function index()
    {
        return view('cases.index', [
            'allCases' => MedCase::where('status', 1)->get(),
        ]);
    }

    public function medCaseDone(MedCase $medcase)
    {
        $medcase->status = 2; //Close
        //$medcase->stopped = date('Y-m-d H:i:s');
        $medcase->save();
        Session::flash('message', Lang::get('t.med_case_close_success'));
        return Redirect::to('cases');
    }
}
