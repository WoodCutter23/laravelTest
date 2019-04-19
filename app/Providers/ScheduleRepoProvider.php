<?php

namespace App\Providers;

use App\Contracts\ScheduleRepo;
use App\Repositories\ScheduleRepoWorker;
use Illuminate\Support\ServiceProvider;

class ScheduleRepoProvider extends ServiceProvider
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
        $this->app->singleton(ScheduleRepo::class, function(){
            return new ScheduleRepoWorker();
        });
    }
}
