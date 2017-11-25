<?php
/**
 * Created by PhpStorm.
 * User: sem842
 * Date: 20.11.17
 * Time: 18:42
 */

namespace App\Services;

use App\Contracts\SmenaAlgInterface;
use App\MedSmena;

class SmenaAlg implements SmenaAlgInterface
{
    public function isAvailableTalon()
    {
        $talonsCount = $this->smena->talons->count();
        return $this->smena->patients_plan > $talonsCount;
    }

    public function calcActiveSmenas()
    {
        return MedSmena::where('status', 1)->get();
    }

    public function setSmena($smena)
    {
        $this->smena = $smena;
    }

    /*
    public function talonsCount()
    {
        return $this->smena->talons->count();
    }
    */

    public function generateTalonName()
    {
        $groupName = $this->smena->medService->group->name;
        $counter = $this->smena->talons->count();
        $result = "0000";
        $c = $counter + 1;
        $talonsMap = [
            'Cardio' => 'C',
            'Doctor' => 'D',
            'Therapist' => 'T',
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
}