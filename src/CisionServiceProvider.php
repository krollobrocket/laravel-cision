<?php

namespace Cyclonecode\Cision;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class CisionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CisionService::class, function () {
            return new CisionService(new Client());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cision');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/cision'),
        ]);
        // view('vendor.cision.cision_feed')->share('content', app(CisionService::class)->fetchFeed());
        $this->publishes([
            __DIR__.'/../config/cision.php' => config_path('cision.php'),
        ]);
    }
}
