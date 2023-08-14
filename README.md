# Laravel-Cision

Fetches and exposes news from Cision in Laravel.

## Configuration

    'feed_id'           => 'Cision Feed Id',
    'feed_image_style'  => 'The style to use for images',
    'feed_date_format'  => 'The date format to use',
    'feed_num_items'    => 'Number of items that should be fetched',
    'feed_items_per_page'   => 'Number of items per page',
    'feed_cache_duration' => 30,

## Installation

    composer require cyclonecode/cision
    @php artisan vendor:publish --provider=cyclonecode/cision
    
