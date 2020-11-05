<?php
/*
*  ****************************************************************
*  *** DO NOT ALTER OR REMOVE COPYRIGHT NOTICES OR THIS HEADER. ***
*  ****************************************************************
*  @Author    : Michail Fragkiskos
*  @Created at:  23/Apr/2020 at 17:36
*  @Description of AegeoProvider.php
*  @Project name: aegeoApi
*/

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\ApiConnector;

class ApiProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\ApiConnector', function ($app) {
            return new ApiConnector();
        });
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {

    }
}
