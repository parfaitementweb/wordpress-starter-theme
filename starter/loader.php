<?php

/*
|--------------------------------------------------------------------------
| Composer
|--------------------------------------------------------------------------
|
| Loading Composer Autoload
|
*/

if (! file_exists($composer = __DIR__ . '/../vendor/autoload.php')) {
    die('You must run <code>composer install</code> from the theme directory.');
}

require get_template_directory() . '/vendor/autoload.php';
$core = \Starter\Choke::getInstance();

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
|
*/
require get_template_directory() . '/starter/helpers.php';

/*
|--------------------------------------------------------------------------
| Customize acf-json folder path
| Source: https://www.advancedcustomfields.com/resources/local-json/
|--------------------------------------------------------------------------
|
*/
add_filter('acf/settings/save_json', 'custom_acf_json_save_path');

function custom_acf_json_save_path($path)
{
    return get_stylesheet_directory() . '/acf-json';
}

add_filter('acf/settings/load_json', 'custom_acf_json_load_path');

function custom_acf_json_load_path($paths)
{
    unset($paths[0]);

    $paths[] = get_stylesheet_directory() . '/acf-json';

    return $paths;
}

/*
|--------------------------------------------------------------------------
| Load Carbon Fields
|--------------------------------------------------------------------------
|
*/
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    define( 'Carbon_Fields\URL', get_template_directory_uri(). '/vendor/htmlburger/carbon-fields/' );
//    \Carbon_Fields\Carbon_Fields::boot();
}