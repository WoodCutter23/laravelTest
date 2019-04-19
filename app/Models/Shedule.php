<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * Foreign Key to organisation
     *
     * @var  int  $organisation_id;
     */

    /**
     * Describe week day
     *
     * @var int $day;
     */

    /**
     * Describe time when organisation start work
     *
     * @var time $start_time;
     */

    /**
     *  time when organisation end work
     *
     * @var time $end_time;
     */

    /**
     *  describe file path, which insert this filed
     *
     * @var string $come_from;
     */



    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;
    const SUNDAY = 0;

    protected $table = 'organisations_schedule';
    protected $hidden = ['come_from', 'id' , 'organisation_id'];
    public  $timestamps = false;

    public function organisations()
    {
        return $this->belongsTo(Organisation::class);
    }
}
