<?php
/**
 * Created by PhpStorm.
 * User: sem842
 * Date: 24.11.17
 * Time: 18:11
 */

namespace App\Services;

use App\Contracts\WatchDogInterface;
use App\Watchdog as WatchdogModel;

class WatchDog implements WatchDogInterface
{
    public function __construct()
    {
        //$this->newHash();
    }

    public function calcHash()
    {
        $hashRecord = WatchdogModel::first();
        if ($hashRecord == NULL) {
            return $this->newHash();
        }
        return $hashRecord->watchdog_hash;
    }

    private function calcNewHash() {
        return rand(100,1000);
    }

    public function newHash()
    {
        $hashRecord = WatchdogModel::first();
        if ($hashRecord == NULL) {
            $hashRecord = new WatchdogModel;
            $hashRecord->id = 1;
            $hashRecord->watchdog_hash = $this->calcNewHash();
            $hashRecord->save();
        } else {
            $hashRecord->watchdog_hash = $this->calcNewHash();
            $hashRecord->save();
        }
    }
}