<?php
/**
 * Created by PhpStorm.
 * User: dannychase
 * Date: 27.11.18
 * Time: 16:11
 */

namespace App\Contracts;


interface FileContract
{
    public function parseCSV($path);

    public function move($file);

    public function validateUpload($file);
}