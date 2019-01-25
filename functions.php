<?php

/*
|--------------------------------------------------------------------------
| Theme Core
|--------------------------------------------------------------------------
|
| Load the Magic. Do not edit. Leave on top
|
*/
require get_template_directory() . '/vendor/autoload.php';
$core = new Parfaitement\Core();

/*
|--------------------------------------------------------------------------
| Theme Setup
|--------------------------------------------------------------------------
|
| Modify to setup theme features as you like.
|
*/

add_action('after_setup_theme', function () {
    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'parfaitement'),
        'footer_navigation' => __('Footer Navigation', 'parfaitement')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(get_template_directory('/dist/main.css'));
}, 20);

add_action('widgets_init', function () {
    /**
     * Register sidebars
     * @link https://codex.wordpress.org/Widgetizing_Themes#How_to_display_new_Widget_Areas
     */
    register_sidebar([
        'name' => 'Primary Sidebar',
        'id' => 'sidebar-primary',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ]);
}, 10);
