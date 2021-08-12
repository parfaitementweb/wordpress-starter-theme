<?php

/*
|--------------------------------------------------------------------------
| Theme Core
|--------------------------------------------------------------------------
|
| Load the Magic. Do not edit. Leave on top
|
*/

require get_template_directory() . '/starter/loader.php';

/*
|--------------------------------------------------------------------------
| Auto register Inc files
|--------------------------------------------------------------------------
|
*/

foreach (new DirectoryIterator(__DIR__ . '/inc') as $fileinfo) {
    if (! $fileinfo->isDot()) {
        if ($fileinfo->getExtension() == 'php') {
            require $fileinfo->getPathname();
        }
    }
}

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
     * Enable custom logo
     * @link https://developer.wordpress.org/themes/functionality/custom-logo/
     */
    $defaults = [
        'flex-height' => true,
        'flex-width' => true,
    ];
    add_theme_support('custom-logo', $defaults);

    /**
     * Enable padding control
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    add_theme_support('custom-spacing');

    /**
     * Enable gutenberg editor style
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_theme_support('editor-styles');
    add_editor_style('/dist/editor-style.css');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'starter_theme')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Adding post thumbnails
     * Those mirrors the TailwindCSS default breakpoints
     */
//    add_image_size('sm', 640);
//    add_image_size('md', 768);
//    add_image_size('lg', 1024);
//    add_image_size('xl', 1280);
//    add_image_size('xl', 1536);

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
     * Enable Gutenberg Default block styles
     */
    add_theme_support('wp-block-styles');

}, 20);

add_action('widgets_init', function () {
    /**
     * Register sidebars
     * @link https://codex.wordpress.org/Widgetizing_Themes#How_to_display_new_Widget_Areas
     */
    register_sidebar([
        'name' => esc_html__('Sidebar', 'theme_starter'),
        'id' => 'sidebar-primary',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ]);
}, 10);


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function custom_content_width()
{
    $GLOBALS['content_width'] = apply_filters('custom_content_width', 1536);
}

add_action('after_setup_theme', 'custom_content_width', 0);


/**
 * Allow adminstrators to upload SVG.
 *
 */
add_filter('upload_mimes', 'parf_add_svg_mime');
function parf_add_svg_mime($mimes)
{
    if (! current_user_can('edit_theme_options')) {
        return $mimes;
    }
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}

/*
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
|
*/

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/dist/main.css', [], filemtime(get_stylesheet_directory() . '/dist/main.css'), 'all');
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/dist/app.js', [], filemtime(get_stylesheet_directory() . '/dist/app.js'), true);
    wp_enqueue_script('alpinejs', 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js', [], '2.8.2');
});

/*
|--------------------------------------------------------------------------
| Passing variables to views
|--------------------------------------------------------------------------
|
| add_filter('theme/template/front-page/data', function (array $data) {
|     $data['foo'] = 'bar';
|
|     return $data;
| });
*/

add_filter('acf/load_value/key=field_61139dab27ca6', 'default_value_field_61139dab27ca6', 10, 3);

function default_value_field_61139dab27ca6($value, $post_id, $field)
{
    if ($value === false) {
        $value = array(
            array(
                'field_61139db927ca7' => array(
                    'field_61139dc627ca8' => array(
                        'title' => 'See our products',
                        'url' => '#',
                        'target' => '',
                    ),
                    'field_61139de827ca9' => 'normal',
                )
            ),
            array(
                'field_61139db927ca7' => array(
                    'field_61139dc627ca8' => array(
                        'title' => 'Discover more',
                        'url' => '#',
                        'target' => '',
                    ),
                    'field_61139de827ca9' => 'outline',
                )
            ),
        );
    }

    return $value;
}
