<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\FileRepo;
use App\Contracts\ScheduleRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Contracts\FileContract;

class FileUploadController extends Controller
{
    protected $fileWorker;
    protected $fileRepo;
    protected $scheduleRepo;

    public function __construct(FileContract $file, FileRepo $fileRepo, ScheduleRepo $scheduleRepo)
    {

        $this->fileWorker = $file;
        $this->fileRepo = $fileRepo;
        $this->scheduleRepo = $scheduleRepo;
    }

    /**
     * @SWG\Post(
     *   path="/api/V1/file",
     *   summary="Upload file with organisations",
     *   operationId="uploadOrgsFile",
     *   tags={"file"},
     *   @SWG\Parameter(
     *     name="file",
     *     in="form/data",
     *     description="file with orgs",
     *     required=true,
     *     type="binary"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=400, description="problem with file"),
     *   @SWG\Response(response=422, description="failed validation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function fileUpload(FileRequest $request)
    {

        $file = $request->file;

        $this->fileWorker->validateUpload($file);

        $movedFileMeta = $this->fileWorker->move($file);

        $this->fileRepo->save($movedFileMeta);

        $parsedData = $this->fileWorker->parseCSV( $movedFileMeta['path']);

        $this->scheduleRepo->add($parsedData, $movedFileMeta['path']);
    }

}
