<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleIntervalRequest;
use App\Contracts\ScheduleRepo;

/**
 * @SWG\Get(
 *   path="/api/V1/schedule",
 *   summary="Get all organisations schedule",
 *   operationId="getAllSchedule",
 *   tags={"schedule"},
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=404, description="not found schedule"),
 *   @SWG\Response(response=500, description="internal server error")
 * ),
 */



class ScheduleController extends Controller
{

    protected  $schedule;

    public function __construct(ScheduleRepo $schedule)
    {
        $this->schedule = $schedule;
    }


    public function getAll()
    {
        $all = $this->schedule->getAll();

        return response()
            ->json($all,200);
    }


    /**
     * @SWG\Get(
     *   path="/api/V1/schedule/filter",
     *   summary="Get Oraganisations by interval",
     *   operationId="getOrgsByInterval",
     *   tags={"schedule"},
     *   @SWG\Parameter(
     *     name="start",
     *     in="body",
     *     description="time when org starts work",
     *     required=true,
     *     type="time"
     *   ),
     *     @SWG\Parameter(
     *     name="end",
     *     in="body",
     *     description="time when org ends work",
     *     required=true,
     *     type="time"
     *   ),
     *      *     @SWG\Parameter(
     *     name="day",
     *     in="body",
     *     description=" number of day from 0 (Sun) to 6 (Sat), if not set, server will autodetect day  of the week ",
     *     required=false,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=400, description="problem with file"),
     *   @SWG\Response(response=422, description="failed validation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function getByInterval(ScheduleIntervalRequest $request)
    {
        $params = $request->all();

        if (!isset($params['day'])) {
            $params['day'] = date('w');
        }

        $schedule = $this->schedule->getByInterval($params);

        return response()
            ->json($schedule,200);
    }

}
