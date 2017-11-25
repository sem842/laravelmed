<?php
/**
 * Created by PhpStorm.
 * User: sem842
 * Date: 24.11.17
 * Time: 18:07
 */

namespace App\Contracts;

interface WatchDogInterface
{
    public function calcHash();
    public function newHash();
}