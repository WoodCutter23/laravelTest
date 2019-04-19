<?php

namespace App\Repositories;

use App\Exceptions\InternalServerErrorException;
use App\Exceptions\NotFoundException;
use App\Models\Organisation;
use App\Models\Schedule;
use App\Contracts\OrganisationsRepo;
use App\Contracts\ScheduleRepo;
use Illuminate\Support\Facades\DB;
use Exception;

class ScheduleRepoWorker implements ScheduleRepo
{

    /**
     * Get all organisations schedule
     *
     * @param  void
     *
     * @return array
     *
     * @throws
     *
     *
     *  */
    public function getAll() : array
    {
        $schedule = Organisation::with('schedule')->get()->toArray();

        if (!$schedule) {
            throw new NotFoundException('Organisations not found');
        }

        return $schedule;
    }

    /**
     * Add new schedule at DB
     *
     * @param  $array array
     *
     * @param  $path string
     *
     * @return void
     *
     * @throws
     *
     *  */

    public function add($array, $path) : void
    {
        DB::beginTransaction();
        try {
            foreach ($array as $shedule) {
                $company_name = $shedule[0];
                array_shift($shedule);

                $org_id = app()->make(OrganisationsRepo::class)->add($company_name);

                for($i = 0; $i < 7; $i ++) {
                    $this->addSchedule(
                        $org_id, $i, $path, $shedule[$i]['start'], $shedule[$i]['end']
                    );
                }
            }
        DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new InternalServerErrorException($e->getMessage());
        }
    }


    /**
     * Get organisations which work in set time interval
     *
     * @param  array
     *
     * @return array
     *
     * @throws NotFoundException
     *
     *  */

    public function getByInterval($array) : array
    {
        $day = $array['day'];
        $timeStart = $array['start'];
        $timeEnd = $array['end'];

        $organisations = Organisation::whereHas(
            'schedule', function ($query) use ($day, $timeStart, $timeEnd) {
            $query->where('day', '=', $day)
                  ->where('start_time', '<=', $timeStart)
                  ->where('end_time','>=', $timeEnd);
        })->get()->toArray();

        if(!$organisations) {
            throw new NotFoundException('Organisations in Interval Not Found');
        }

        return $organisations;
    }

    /**
     * Helpers function to add new schedule in DB
     *
     * @param  $orgId int
     *
     * @param $day int
     *
     * @param  $comeFrom string
     *
     * @param  $timeStart string
     *
     * @param $timeEnd string
     *
     * @throws
     *
     *  */

    protected function addSchedule($orgId, $day, $comeFrom, $timeStart, $timeEnd) : void
    {
        $schedule = new Schedule();
        $schedule->day = $day;
        $schedule->come_from = $comeFrom;
        $schedule->start_time = $timeStart;
        $schedule->end_time = $timeEnd;
        $schedule->organisation_id = $orgId;

        $schedule->save();
    }
}
