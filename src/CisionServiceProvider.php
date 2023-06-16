<?php

namespace Cyclonecode\Cision;

use Cyclonecode\Cision\Commands\FetchFeed;
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
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchFeed::class,
            ]);
        }
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cision');
        View::composer('cision::cision_feed', function () {
            /** @var \Cyclonecode\Cision\CisionService $service */
            $service = \App::make(CisionService::class);
            $content = $service->fetchFeed();
            $pagination = null;
            if (\config('cision.feed_items_per_page')) {
                $pagination = $service->createPagination($content);
            }
            View::share(
                'content', $content
            );
            View::share(
                'pagination', $pagination
            );
            View::share('settings', \config('cision'));
        });
        $this->publishes([
            __DIR__.'/../config/cision.php' => config_path('cision.php'),
        ]);
        $this->publishes([
            __DIR__.'/../resources/css' => public_path('vendor/cision'),
        ], 'public');
    }
}
