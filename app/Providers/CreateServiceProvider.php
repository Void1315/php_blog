<?php

namespace App\Providers;
use App\Services\CreateService;
use Illuminate\Support\ServiceProvider;

class CreateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
            $this->app->singleton('creator',function(){
            return new CreateService();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
