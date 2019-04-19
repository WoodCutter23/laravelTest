<?php

namespace App\Providers;

use App\Contracts\OrganisationsRepo;
use App\Repositories\OrganisationsRepoWorker;
use Illuminate\Support\ServiceProvider;

class OrganisationsRepoProvider extends ServiceProvider
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
        $this->app->singleton(OrganisationsRepo::class, function(){
            return new OrganisationsRepoWorker();
        });
    }
}
