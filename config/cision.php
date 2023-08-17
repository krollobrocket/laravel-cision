<?php

return [
    'feed_id'           => env('CISION_FEED_ID', 'A275C0BF733048FFAE9126ACA64DD08F'),
    'feed_image_style'  => env('CISION_FEED_IMAGE_STYLE', 'UrlTo400x400ArResized'),
    'feed_date_format'  => env('CISION_FEED_DATE_FORMAT', 'Y-m-d'),
    'feed_num_items'    => env('CISION_FEED_NUM_ITEMS', 50),
    'feed_items_per_page'   =>env('CISION_FEED_ITEMS_PER_PAGE', 0),
    'feed_cache_duration' => env('CISION_FEED_CACHE_DURATION', 0),
    'feed_base_slug'    => env('CISION_FEED_BASE_SLUG', 'cision'),
];
