<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\FileContract;

use App\Servicies\FileService;

class FileServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FileContract::class, function(){
            return new FileService();
        });
    }
}
