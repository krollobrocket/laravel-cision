<?php

namespace Cyclonecode\Cision;

use GuzzleHttp\Client;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CisionService
{
    protected const CISION_NEWS_ENDPOINT = 'https://publish.ne.cision.com/papi/NewsFeed/';
    protected const CISION_ARTICLE_ENDPOINT = 'http://publish.ne.cision.com/papi/Release/';
    protected const DEFAULT_CACHE_DURATION = 30 * 5;
    protected const CACHE_NEWS_KEY = 'cision_news';
    protected const CACHE_ARTICLE_KEY = 'cision_article';
    protected const DEFAULT_NUM_ITEMS = 50;

    private string $pagination = '';

    public function __construct(private Client $client)
    {
        $this->scheduleCommand();
    }

    protected function scheduleCommand()
    {
        $schedule = new Schedule();
        $schedule->command('cision-feed:fetch')
            // ->cron('*****')
            ->everyMinute();
            // ->withoutOverlapping()
            // ->runInBackground();
    }

    public function createPagination(array &$items): string
    {
        $pagination = '';
        $page = \request()->query->get('p', 1) - 1;
        $items_per_page = \config('cision.feed_items_per_page', 0);
        if ($items_per_page) {
            $num_pages = (int)ceil(count($items) / $items_per_page);
            if ($num_pages > 1) {
                $pagination = '<div class="pagination"><ul>';
                $items = array_slice(
                    $items,
                    $page * \config('cision.feed_items_per_page'),
                    \config('cision.feed_items_per_page')
                );
                for ($i = 0; $i < $num_pages; $i++) {
                    $pagination .= '<li><a href="?p=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
                }
                $pagination .= '</ul></div>';
            }
        }
        return $pagination;
    }

    public function fetchArticle(string $id)
    {
        $content = Cache::get(self::CACHE_ARTICLE_KEY . $id);
        if (!$content) {
            try {
                $content = \json_decode(
                    $this->client->get(
                        self::CISION_ARTICLE_ENDPOINT . $id,
                        [
                            'query' => [
                                'Format' => 'json',
                            ]
                        ]
                    )->getBody()
                        ->getContents()
                );
                $content = FeedItem::fromObject($content->Release);
            } catch (\Exception $exception) {
                dd($exception);
                \abort($exception->getCode());
            }
            Cache::put(
                self::CACHE_ARTICLE_KEY . $id,
                $content,
                \config('cision.feed_cache_duration', self::DEFAULT_CACHE_DURATION)
            );
        }
        return $content;
    }

    public function fetchFeed()
    {
        // config(['cision.feed_cache_duration' => 10]);
        $cacheKey = md5(self::CACHE_NEWS_KEY . \request()->getQueryString());
        $content = Cache::get($cacheKey);
        if (!$content) {
            try {
                $content = \json_decode(
                    $this->client->get(
                        self::CISION_NEWS_ENDPOINT . config('cision.feed_id'),
                        [
                            'query' => [
                                'DetailLevel' => 'detail',
                                'PageIndex' => 1,
                                'PageSize' => \config('cision.feed_num_items', self::DEFAULT_NUM_ITEMS),
                                'Format' => 'json',
                            ]
                        ]
                    )->getBody()
                        ->getContents()
                );
            } catch (\Exception $exception) {
            }
            $items = $content->Releases ?? [];
            $this->pagination = $this->createPagination($items);
            $content = Collection::make(FeedItem::arrayFromJson(\json_encode($items)));
            $cache = new \stdClass();
            $cache->content = $content;
            $cache->pagination = $this->pagination;
            $content = $cache;
            Cache::put(
                $cacheKey,
                $content,
                \config('cision.feed_cache_duration', self::DEFAULT_CACHE_DURATION)
            );
        }
        return $content;
    }
}
