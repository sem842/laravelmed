<?php
/**
 * Created by PhpStorm.
 * User: sem842
 * Date: 20.11.17
 * Time: 19:11
 */

namespace App\Contracts;

interface ISmenaAlg
{
    public function isAvailableTalon();
    public function calcActiveSmenas();
    public function setSmena($smena);
    public function generateTalonName();
}