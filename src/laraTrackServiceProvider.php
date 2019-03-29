<?php

namespace miketan\laraTrack;

use Illuminate\Support\ServiceProvider;

use miketan\laraTrack\CrashReportClass;
class laraTrackServiceProvider extends ServiceProvider
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

        $this->app->bind('crashReport', function() {
            return new CrashReportClass;
        });
        include __DIR__.'/routes.php';

    }
}
