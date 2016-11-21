<?php

namespace Nxb\Timezones;

use Illuminate\Support\ServiceProvider;

class TimezonesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //--- include custom routes
        include __DIR__.'/routes.php';

        //--- load views form folder i.e., timezones will be used as namespace timezones::time
        //$this->loadViewsFrom(__DIR__.'/views', 'timezones');

        if(config('timezones.package_view')==false){
            $real_path = config('timezones.view_path');
        }
        else{
            $real_path = __DIR__.'/views';   
        }

        
        $this->loadViewsFrom($real_path, 'timezones');

        //__DIR__.'/views' => base_path('resources/views/nxb/timezones')
        
        //--- Register configuration file
        $this->publishes([
            __DIR__.'/config/timezones.php' => config_path('timezones.php')
        ], 'config');


        //--- Publish the custom template for used frontend
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/timezones')
        ], 'timezones');
    }

    /**
     * Register the application services.
     *
     * @return void

     */
    public function register()
    {

        //--- Add controller
        $this->app->make('Nxb\Timezones\TimezonesController');

    }


    /**
    ** Register the resources->view path
    ** Future use
    */
    public function registerViewFinder()
    {

        $this->app->bind('view.timezones', function($app){
            $paths = $app['config']['timezones.paths'];
            return new FileViewFinder($app['files'], $paths);
        });
    }


}
