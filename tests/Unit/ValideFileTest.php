<?php

namespace Tests\Unit;

use App\Exceptions\BadRequestException;
use App\Servicies\FileService;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ValideFileTest extends TestCase
{

    public function testBasicTest()
    {
        Storage::fake('imported');

        $file = UploadedFile::fake()->image('avatar.jpg');
        $fileWork = new FileService();

        $this->expectException(BadRequestException::class);

        $fileWork->validateUpload($file);

    }
}
