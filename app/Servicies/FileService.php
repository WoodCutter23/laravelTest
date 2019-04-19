<?php

namespace App\Servicies;

use App\Exceptions\BadRequestException;
use Illuminate\Support\Facades\Storage;
use App\Contracts\FileContract;
use App\Exceptions\InternalServerErrorException;

class FileService implements FileContract
{

    protected $parsedFormats;

    public function __construct()
    {
        $this->parsedFormats =  config('app.parseFormats');
    }

    /**
     * Check file format and success upload
     *
     * @param  $file \Illuminate\Http\File
     *
     * @return void
     *
     * @throws BadRequestException
     *
     *
     *  */

    public function validateUpload($file) : void
    {
        if ($file->isValid()) {

            $extension = $file->getClientOriginalExtension();

           if (!$extension) {
               throw (new BadRequestException('Bad Request'))
                   ->withData(['Message' => 'Impossible determinate file extension, please try again ']);
           }

           if (!in_array($extension, $this->parsedFormats)) {
               throw (new BadRequestException('Bad Request'))
                   ->withData(['Message' => 'Not allowed file format, please see docs']);
           }

        } else {
            throw (new BadRequestException('Bad Request'))
                ->withData(['Message' => 'FileContract upload failed, please try again']);
        }
    }

    /**
     * Move file with new server name
     *
     * @param  $file \Illuminate\Http\File
     *
     * @return array
     *
     * @throws InternalServerErrorException
     *
     *
     *  */
    public function move($file) : array
    {
        $oldName = $file->getClientOriginalName();

        $newName = strtotime('r');

        $customerExtension = $file->getClientOriginalExtension();

        $path = $file->storeAs('imported', $newName.'.'.$customerExtension);

        if (!$path) {
            throw (new InternalServerErrorException('Internal Server Error'))
                ->withData(['Message' => 'Try again']);
        }

        return [
            'path' => $path,
            'oldName' => $oldName,
            'newName' => $newName,
            'customerExtension' => $customerExtension
        ];
    }

    /**
     * Do parse of uploaded file
     *
     * @param  string
     *
     * @return array
     *
     * @throws BadRequestException
     *
     *
     *  */
    public function parseCSV($path) : array
    {

        $contents = Storage::get($path);
        $csv = explode("\n", $contents);

        foreach ($csv as $key => $line) {
            $csv[$key] = str_getcsv($line);
        }

        $this->valideCSV($csv);

        $csv = $this->sortCSV($csv);

        return $csv;

    }


    /**
     * Check the upload file structure structure
     *
     * @param  $array array
     *
     * @return void
     *
     * @throws BadRequestException
     *
     *
     *  */
    protected function valideCSV($array) : void
    {
        foreach ($array as $item) {

            if (count($item) != 15) {
                throw (new BadRequestException('Bad Request'))
                    ->withData(['Message' => 'Wrong file structure']);
            }
        }
    }

    /**
     * Sort array after csv parsng
     *
     * @param  $array array
     *
     * @return array
     *
     *
     *  */
    protected function sortCSV($array) : array {
        $timeSheets = [];

        foreach ($array as $company) {
            $timeSheet = [$company[0]];
            array_shift($company);

            for($i = 0; $i < 14; $i = $i + 2 ) {
                $day[] = ['start' =>$company[$i], 'end' => $company[$i + 1]];
                $timeSheet = array_merge($timeSheet, $day);
                unset($day);
            }

            $timeSheets[] = $timeSheet;
        }

        return $timeSheets;
    }
}
