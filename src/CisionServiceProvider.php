<?php

namespace Cyclonecode\Cision;

use Cyclonecode\Cision\Commands\FetchFeed;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CisionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            CisionService::class,
            function () {
                return new CisionService(
                    new Client(
                        [
                        'headers' => [
                        'Content-type' => 'application/json',
                        'Accept' => 'application/json',
                        ],
                        ]
                    )
                );
            }
        );
        $this->app->singleton(
            'CisionSerializer',
            function () {
                $phpDocExtractor = new PhpDocExtractor();
                $reflectionExtractor = new ReflectionExtractor();

                $propertyInfoExtractor = new PropertyInfoExtractor(
                    [$reflectionExtractor],
                    [$phpDocExtractor, $reflectionExtractor],
                    [], //[$phpDocExtractor],
                    [], //[$reflectionExtractor],
                    [], //[$reflectionExtractor]
                );

                $encoders = [new JsonEncoder()];
                $normalizers = [
                new ObjectNormalizer(
                    null,
                    null,
                    null,
                    $propertyInfoExtractor
                ),
                new ArrayDenormalizer(),
                ];

                $serializer = new Serializer($normalizers, $encoders);
                return $serializer;
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                [
                FetchFeed::class,
                ]
            );
        }
        $this->loadRoutesFrom(__DIR__ . '/../routes/cision.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cision');
        View::composer(
            'cision::article',
            function ($id) {
                $parsed = explode('/', parse_url(\request()->getUri())['path']);
                $id = end($parsed);
                /**
            * @var \Cyclonecode\Cision\CisionService $service
            */
                $service = \App::make(CisionService::class);
                $content = $service->fetchArticle($id);
                View::share('content', $content);
            }
        );
        View::composer(
            'cision::feed',
            function () {
                /**
            * @var \Cyclonecode\Cision\CisionService $service
            */
                $service = \App::make(CisionService::class);
                $content = $service->fetchFeed();
                View::share(
                    'content',
                    $content->content
                );
                View::share(
                    'pagination',
                    $content->pagination
                );
                View::share('settings', \config('cision'));
                View::share('config', new FeedSettings());
            }
        );
        $this->publishes(
            [
            __DIR__ . '/../config/cision.php' => config_path('cision.php'),
            ]
        );
        $this->publishes(
            [
            __DIR__ . '/../resources/css' => public_path('vendor/cision'),
            ],
            'public'
        );
    }
}
