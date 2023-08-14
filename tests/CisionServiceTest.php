<?php

use Cyclonecode\Cision\CisionService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Orchestra\Testbench\TestCase;

class CisionServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        config([
            'cision.feed_id' => 'A275C0BF733048FFAE9126ACA64DD08F',
            'cision.feed_cache_duration' => 0,
            'cision.feed_image_style' => 'DownloadUrl',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cyclonecode\Cision\CisionServiceProvider',
        ];
    }

    public function testCreateEmptyPagination()
    {
        \App::bind(CisionService::class, function ($app) {
            $content = file_get_contents(__DIR__ . '/press-feed.json');
            $mock = new MockHandler([new Response(200, [], \json_encode(\json_decode($content)->Releases[0]))]);
            $handler = HandlerStack::create($mock);
            $client = new Client([
                'handler' => $handler,
            ]);

            return new CisionService($client);
        });
        /** @var CisionService $service */
        $service = \App::make(CisionService::class);
        $content = $service->fetchFeed();
        $this->assertNotNull($content->pagination);
        $this->assertEmpty($content->pagination);
    }

    public function testCreatePagination()
    {
        \config(['cision.feed_items_per_page' => 1]);
        \App::bind(CisionService::class, function ($app) {
            $content = file_get_contents(__DIR__ . '/press-feed.json');
            $mock = new MockHandler([new Response(200, [], $content)]);
            $handler = HandlerStack::create($mock);
            $client = new Client([
                'handler' => $handler,
            ]);

            return new CisionService($client);
        });
        /** @var CisionService $service */
        $service = \App::make(CisionService::class);
        $content = $service->fetchFeed();
        $this->assertNotNull($content->pagination);
        $this->assertNotEmpty($content->pagination);
    }

    public function testFetchFeed()
    {
        \App::bind(CisionService::class, function ($app) {
            $content = file_get_contents(__DIR__ . '/press-feed.json');
            $mock = new MockHandler([new Response(200, [], $content)]);
            $handler = HandlerStack::create($mock);
            $client = new Client([
                'handler' => $handler,
            ]);

            return new CisionService($client);
        });
        /** @var CisionService $service */
        $service = \App::make(CisionService::class);
        $feed = $service->fetchFeed();
        $this->assertIsObject($feed);
        $this->assertInstanceOf(Collection::class, $feed->content);
        $this->assertIsString($feed->pagination);
    }

    public function testFetchEmptyFeed()
    {
        \App::bind(CisionService::class, function ($app) {
            $mock = new MockHandler([new Response(200, [], '')]);
            $handler = HandlerStack::create($mock);
            $client = new Client([
                'handler' => $handler,
            ]);

            return new CisionService($client);
        });
        /** @var CisionService $service */
        $service = \App::make(CisionService::class);
        $feed = $service->fetchFeed();
        $this->assertIsObject($feed);
        $this->assertInstanceOf(Collection::class, $feed->content);
        $this->assertEmpty($feed->content);
        $this->assertIsString($feed->pagination);
        $this->assertEmpty($feed->pagination);
    }

    public function testFetchArticle()
    {
        \App::bind(CisionService::class, function ($app) {
            $content = file_get_contents(__DIR__ . '/article.json');
            $mock = new MockHandler([new Response(200, [], $content)]);
            $handler = HandlerStack::create($mock);
            $client = new Client([
                'handler' => $handler,
            ]);

            return new CisionService($client);
        });
        /** @var CisionService $service */
        $service = \App::make(CisionService::class);
        $post = $service->fetchArticle('foobar');
        $this->assertIsObject($post);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param $object
     * @param $methodName
     * @param array $parameters
     * @return mixed
     * @throws ReflectionException
     */
    protected function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
