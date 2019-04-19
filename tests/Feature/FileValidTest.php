<?php

namespace Tests\Feature;


use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class FileValid extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        Storage::fake('imported');

        $response = $this->json('POST', '/api/v1/file', [
            'file' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        $this->assertEquals(400, $response->getStatusCode());
    }
}
