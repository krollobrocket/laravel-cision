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
    const DEFAULT_NUM_ITEMS = 50;

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

    protected function mapFeedItem($it)
    {
        if ($it->Images && \config('cision.feed_image_style')) {
            $it->Image = (object) [
                'Title' => $it->Images[0]->Title,
                'Description' => '',
                'Url' => $it->Images[0]->{\config('cision.feed_image_style')},
            ];
            unset($it->Images);
        }
        return $it;
    }

    public function fetchFeed()
    {
        $content = Cache::get(self::CACHE_NEWS_KEY);
        if (!$content) {
            $content = \json_decode($this->client->get(self::CISION_NEWS_ENDPOINT . config('cision.feed_id'), [
                'query' => [
                    'DetailLevel' => 'detail',
                    'PageIndex' => 1,
                    'PageSize' => \config('cision.feed_num_items', self::DEFAULT_NUM_ITEMS),
                    'Format' => 'json',
                ]
            ])->getBody()
                ->getContents());
            $content = Collection::make(array_map([$this, 'mapFeedItem'], $content->Releases ?: []));
            Cache::put(self::CACHE_NEWS_KEY, $content, 30);
        }
        return $content;
    }
}
