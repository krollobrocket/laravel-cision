<?php

function validateImageStyle(string $style)
{
    return in_array($style, [
        'DownloadUrl',
        'UrlTo100x100Thumbnail',
        'UrlTo200x200Thumbnail',
        'UrlTo100x100ArResized',
        'UrlTo200x200ArResized',
        'UrlTo400x400ArResized',
        'UrlTo800x800ArResized',
    ]) ? $style : null;
}

return [
    'feed_id'           => env('CISION_FEED_ID', 'A275C0BF733048FFAE9126ACA64DD08F'),
    'feed_news_types'   => explode(',', env('CISION_FEED_NEWS_TYPES', 'KMK, RDV, PRM, RPT, INB, NBR')),
    'feed_image_style'  => validateImageStyle(env('CISION_FEED_IMAGE_STYLE', 'UrlTo400x400ArResized')),
    'feed_date_format'  => env('CISION_FEED_DATE_FORMAT', 'Y-m-d'),
    'feed_num_items'    => env('CISION_FEED_NUM_ITEMS', 50),
    'feed_items_per_page'   => env('CISION_FEED_ITEMS_PER_PAGE', 0),
    'feed_cache_duration' => env('CISION_FEED_CACHE_DURATION', 0),
    'feed_base_slug'    => env('CISION_FEED_BASE_SLUG', 'cision'),
];
