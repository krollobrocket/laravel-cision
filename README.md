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
