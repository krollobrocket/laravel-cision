<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
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
        \App::bind(\Cyclonecode\Cision\CisionService::class, function ($app) {
            $mock = new MockHandler([new Response(200, [], '{}')]);
            $handler = HandlerStack::create($mock);
            $client = new Client([
                'handler' => $handler,
            ]);
            return new \Cyclonecode\Cision\CisionService($client);
        });
        /** @var \Cyclonecode\Cision\CisionService $service */
        $service = \App::make(\Cyclonecode\Cision\CisionService::class);
        $content = $service->fetchFeed();
        $pagination = $service->createPagination($content);
        $this->assertNotNull($pagination);
        $this->assertEmpty($pagination);
    }

    public function testCreatePagination()
    {
        \config(['cision.feed_items_per_page' => 1]);
        \App::bind(\Cyclonecode\Cision\CisionService::class, function ($app) {
            $mock = new MockHandler([new Response(200, [], '{"Releases":[{"Title":"bar"},{"Title":"foo"}]}')]);
            $handler = HandlerStack::create($mock);
            $client = new Client([
                'handler' => $handler,
            ]);
            return new \Cyclonecode\Cision\CisionService($client);
        });
        /** @var \Cyclonecode\Cision\CisionService $service */
        $service = \App::make(\Cyclonecode\Cision\CisionService::class);
        $content = $service->fetchFeed();
        $pagination = $service->createPagination($content);
        $this->assertNotNull($pagination);
        $this->assertNotEmpty($pagination);
    }

    public function testMapFeedItem()
    {
        /** @var \Cyclonecode\Cision\CisionService $service */
        $service = \App::make(\Cyclonecode\Cision\CisionService::class);
        $item = new \stdClass();
        $item->Title = 'foo';
        $item->Images = [];
        $item->Images[0] = new \stdClass();
        $item->Images[0]->Title = 'foo';
        $item->Images[0]->DownloadUrl = 'https://example.jpg';
        $item = $this->invokeMethod($service, 'mapFeedItem', [$item]);
        $this->assertIsObject($item);
        $this->assertObjectHasAttribute('Image', $item);
    }

    public function testFetchFeed()
    {
        \App::bind(\Cyclonecode\Cision\CisionService::class, function ($app) {
            $mock = new MockHandler([new Response(200, [], '{}')]);
            $handler = HandlerStack::create($mock);
            $client = new Client([
                'handler' => $handler,
            ]);
            return new \Cyclonecode\Cision\CisionService($client);
        });
        /** @var \Cyclonecode\Cision\CisionService $service */
        $service = \App::make(\Cyclonecode\Cision\CisionService::class);
        $feed = $service->fetchFeed();
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $feed);
    }

    public function testFetchArticle()
    {
        \App::bind(\Cyclonecode\Cision\CisionService::class, function ($app) {
            $mock = new MockHandler([new Response(200, [], '{"Release":{"Title":"bar"}}')]);
            $handler = HandlerStack::create($mock);
            $client = new Client([
                'handler' => $handler,
            ]);
            return new \Cyclonecode\Cision\CisionService($client);
        });
        /** @var \Cyclonecode\Cision\CisionService $service */
        $service = \App::make(\Cyclonecode\Cision\CisionService::class);
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
