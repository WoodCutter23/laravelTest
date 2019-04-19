<?php

namespace App\Providers;

use App\Contracts\FileRepo;
use App\Repositories\FileRepoWorker;
use Illuminate\Support\ServiceProvider;

class FileRepoProvider extends ServiceProvider
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
        $this->app->singleton(FileRepo::class, function()
        {
            return new FileRepoWorker();
        });
    }
}
