<?php

namespace Cyclonecode\Cision\Commands;

use Cyclonecode\Cision\CisionService;
use Illuminate\Console\Command;

class FetchFeed extends Command
{
    protected $signature = 'cision-feed:fetch';

    protected $description = 'Fetch and update the Cision feed';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch the entire feed
        /** @var CisionService $service */
        $service = \App::make(CisionService::class);
        $feed = $service->fetchFeed();
        $items = \json_decode(\json_encode($feed->content), JSON_OBJECT_AS_ARRAY);
        $items = array_map(function ($item) {
            return [
                'Id' => $item['Id'],
                'Title' => $item['Title'],
                'EncryptedId' => $item['EncryptedId'],
            ];
        }, $items);
        $this->table(
            ['Id', 'Title', 'EncryptedId'],
            $items,
        );
    }
}
