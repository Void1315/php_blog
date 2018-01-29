<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TestService;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
                $this->app->singleton('test',function(){
            return new TestService();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     * @author LaravelAcademy.org
     */
    public function register()
    {
        //使用singleton绑定单例


        //使用bind绑定实例到接口以便依赖注入
        // $this->app->bind('App\Contracts\TestContract',function(){
        //     return new TestService();
        // });
    }
}