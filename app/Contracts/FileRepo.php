<?php
/**
 * Created by PhpStorm.
 * User: dannychase
 * Date: 28.11.18
 * Time: 17:24
 */

namespace App\Contracts;


interface FileRepo
{
    public function save($array);
}