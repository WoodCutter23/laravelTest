<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $table = 'organisations';

    /**
     * Describe organisation's name
     *
     * @var string $name;
     */


    public $timestamps = false;

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'organisation_id');
    }

}
