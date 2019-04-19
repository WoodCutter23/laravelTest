<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The original user's file name
     *
     * @var string  $original_name;
     */


    /**
     * The server name of user file
     *
     * @var string $server_name;
     */



    /**
     * Path of the file on server directory
     *
     * @var string $path;
     */

    protected $table = 'files';

}
