# Laravel-Cision

Fetches and exposes news from Cision in Laravel.

## Configuration

    'feed_id'           => 'Cision Feed Id',
    'feed_news_types'   => 'Type type of news to display',
    'feed_image_style'  => 'The style to use for images',
    'feed_date_format'  => 'The date format to use',
    'feed_num_items'    => 'Number of items that should be fetched',
    'feed_items_per_page'   => 'Number of items per page',
    'feed_cache_duration' => 30,
    'feed_base_slug'    => 'The base slug to use for the news feed',
    'feed_tags'         => 'Tags to filter on',
    'feed_start_date'   => 'Start date to fetch news from',
    'feed_end_date'     => 'End date to fetch news from'

You can also use the following environment variables to set configuration values:

    CISION_FEED_ID=A275C0BF733048FFAE9126ACA64DD08F
    CISION_FEED_NEWS_TYPES=PRM,RPT
    CISION_FEED_IMAGE_STYLE=UrlTo400x400ArResized
    CISION_FEED_DATE_FORMAT=Y-m-d
    CISION_FEED_NUM_ITEMS=50
    CISION_FEED_ITEMS_PER_PAGE=0
    CISION_FEED_CACHE_DURATION=0
    CISION_FEED_BASE_SLUG=ir
    CISION_FEED_TAGS=foo,bar*
    CISION_FEED_START_DATE=2001-01-01*
    CISION_FEED_END_DATE=2010-01-01*

    * not used at the moment

## Information types

The are the different information types that are being used:

- KMK - Annual Financial statement
- RDV - Annual Report
- PRM - Company Announcement
- RPT - Interim Report
- INB - Invitation
- NBR - Newsletter

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
