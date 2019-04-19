<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\ScheduleContract;
use App\Contracts\Workers\ScheduleContractWorker;

class TimeSheetsServiceProvedir extends ServiceProvider
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
        $this->app->singleton(ScheduleContract::class, function(){
            return new ScheduleContractWorker();
        });
    }
}
