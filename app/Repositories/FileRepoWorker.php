<?php

namespace App\Repositories;

use App\Exceptions\InternalServerErrorException;
use App\Models\File;
use App\Contracts\FileRepo;

class FileRepoWorker implements FileRepo
{
    /**
     * Check the upload file structure structure
     *
     * @param $array array
     *
     * @return void
     *
     * @throws
     *  */
    public function save($array) : void
    {

       $file = new File();
       $file->server_name = $array['newName'].".".$array['customerExtension'];
       $file->path = $array['path'];
       $file->original_name = $array['oldName'];


       if (!$file->save()) {
           throw  new InternalServerErrorException('Internal Server Error');
       }
    }
}
