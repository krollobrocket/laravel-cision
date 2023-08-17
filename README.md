# Laravel-Cision

Fetches and exposes news from Cision in Laravel.

## Configuration

    'feed_id'           => 'Cision Feed Id',
    'feed_image_style'  => 'The style to use for images',
    'feed_date_format'  => 'The date format to use',
    'feed_num_items'    => 'Number of items that should be fetched',
    'feed_items_per_page'   => 'Number of items per page',
    'feed_cache_duration' => 30,
    'feed_base_slug'    => 'The base slug to use for the news feed',

You can also use the following environment variables to set configuration values:

    CISION_FEED_ID=A275C0BF733048FFAE9126ACA64DD08F
    CISION_FEED_IMAGE_STYLE=UrlTo400x400ArResized
    CISION_FEED_DATE_FORMAT=Y-m-d
    CISION_FEED_NUM_ITEMS=50
    CISION_FEED_ITEMS_PER_PAGE=0
    CISION_FEED_CACHE_DURATION=0
    CISION_FEED_BASE_SLUG=ir

## Installation

First add the repository in your `composer.json` file:

    "repositories": [
        {
            "url": "https://github.com/krollobrocket/laravel-cision.git",
            "type": "git"
        }
    ],

Then require and publish the package:

    composer require cyclonecode/cision
    php artisan vendor:publish
    # Now you can add your own configuration to the config/cision.php file.
    # Then go to route configured by 'feed_base_slug' to view your news feed.
