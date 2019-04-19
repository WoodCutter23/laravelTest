<?php

namespace App\Contracts;

interface ScheduleRepo
{
    public function add($array, $path);

    public function getAll();

    public  function getByInterval($array);
}
