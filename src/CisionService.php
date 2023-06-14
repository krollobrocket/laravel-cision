<?php

namespace Cyclonecode\Cision;

use GuzzleHttp\Client;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CisionService
{
    const CISION_NEWS_ENDPOINT = 'https://publish.ne.cision.com/papi/NewsFeed/';
    const DEFAULT_CACHE_DURATION = 30 * 5;
    const CACHE_NEWS_KEY = 'cision_news';

    public function __construct(private Client $client)
    {
    }

    protected function scheduleCommand()
    {
        $schedule = new Schedule();
        $schedule->command('analytics:report')
            ->daily()
            ->runInBackground();
    }

    public function fetchFeed()
    {
        $content = Cache::get(self::CACHE_NEWS_KEY);
        if (!$content) {
            $content = \json_decode($this->client->get(self::CISION_NEWS_ENDPOINT . config('cision.feed_id'), [
                'DetailLevel' => 'detail',
                'PageSize' => 50,
                'Format' => 'json',
            ])->getBody()
                ->getContents());
            $content = Collection::make($content->Releases);
            Cache::put(self::CACHE_NEWS_KEY, $content, 30);
        }
        return $content;
        // dd($content);
    }
}
