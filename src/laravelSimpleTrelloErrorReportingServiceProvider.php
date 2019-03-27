<?php

namespace miketan\laravelSimpleTrelloErrorReporting;

use Illuminate\Support\ServiceProvider;

class laravelSimpleTrelloErrorReportingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->loadRoutesFrom(__DIR__.'/routes.php');
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

        $this->publishes([
            __DIR__.'/migrations/' => database_path('migrations')
        ], 'migrations');

        
        //$this->loadMigrationsFrom(__DIR__.'/migrations');
        //$this->loadViewsFrom(__DIR__.'/views', 'laravelSimpleTrelloErrorReporting');
        // $this->publishes([
        //     __DIR__.'/views' => base_path('resources/views/miketan/laravelSimpleTrelloErrorReporting'),
        // ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('CrashReport', function() {
            dd('aaa');
            return new CrashReport;
        });
        include __DIR__.'/routes.php';
        //$this->app->make('Laraveldaily\Timezones\TimezonesController');

         $this->app->make('miketan\laravelSimpleTrelloErrorReporting\CrashReportController');
    }
}
