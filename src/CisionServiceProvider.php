<?php

namespace Cyclonecode\Cision;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;
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
            return new CisionService(new Client([
                'headers' => [
                    'Content-type' => 'application/json',
                    'Accept' => 'application/json',
                ],
            ]));
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
        View::composer('cision::cision_feed', function () {
            View::share(
                'content', \App::make(CisionService::class)->fetchFeed()
            );
            View::share('settings', \config('cision'));
        });
        $this->publishes([
            __DIR__.'/../config/cision.php' => config_path('cision.php'),
        ]);
    }
}
