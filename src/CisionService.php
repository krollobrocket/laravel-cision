<?php

namespace Cyclonecode\Cision;

use GuzzleHttp\Client;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CisionService
{
    const CISION_NEWS_ENDPOINT = 'https://publish.ne.cision.com/papi/NewsFeed/';
    const CISION_ARTICLE_ENDPOINT = 'http://publish.ne.cision.com/papi/Release/';
    const DEFAULT_CACHE_DURATION = 30 * 5;
    const CACHE_NEWS_KEY = 'cision_news';
    const CACHE_ARTICLE_KEY = 'cision_article';
    const DEFAULT_NUM_ITEMS = 50;

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

    protected function mapFeedItem($it)
    {
        if (!empty($it->Images) && \config('cision.feed_image_style')) {
            $it->Image = (object) [
                'Title' => $it->Images[0]->Title,
                'Description' => '',
                'Url' => $it->Images[0]->{\config('cision.feed_image_style')},
            ];
            unset($it->Images);
        }
        $it->Title = \strip_tags($it->Title);
        return $it;
    }

    public function createPagination(Collection &$content): string
    {
        $pagination = '';
        $page = \request()->query->get('p', 1) - 1;
        $items_per_page = \config('cision.feed_items_per_page', 0);
        if ($items_per_page) {
            $num_pages = (int)ceil(count($content) / $items_per_page);
            if ($num_pages > 1) {
                $pagination = '<div class="pagination"><ul>';
                $content = $content->slice($page * \config('cision.feed_items_per_page'), \config('cision.feed_items_per_page'));
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
            $content = \json_decode($this->client->get(self::CISION_ARTICLE_ENDPOINT . $id, [
                'query' => [
                ]
            ])->getBody()
                ->getContents());
            $content = $this->mapFeedItem($content->Release ?? $content);
            Cache::put(self::CACHE_ARTICLE_KEY . $id, $content, \config('cision.feed_cache_duration', self::DEFAULT_CACHE_DURATION));
        }
        return $content;
    }

    public function fetchFeed()
    {
        $content = Cache::get(self::CACHE_NEWS_KEY);
        if (!$content) {
            try {
                $content = \json_decode($this->client->get(self::CISION_NEWS_ENDPOINT . config('cision.feed_id'), [
                    'query' => [
                        'DetailLevel' => 'detail',
                        'PageIndex' => 1,
                        'PageSize' => \config('cision.feed_num_items', self::DEFAULT_NUM_ITEMS),
                        'Format' => 'json',
                    ]
                ])->getBody()
                    ->getContents());
            } catch (\Exception $exception) {
            }
            $content = Collection::make(array_map([$this, 'mapFeedItem'], $content->Releases ?? []));
            Cache::put(self::CACHE_NEWS_KEY, $content, \config('cision.feed_cache_duration', self::DEFAULT_CACHE_DURATION));
        }
        return $content;
    }
}
