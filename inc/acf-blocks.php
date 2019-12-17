<?php

/*
|--------------------------------------------------------------------------
| ACF Blocks
|--------------------------------------------------------------------------
|
| Register your ACF Blocks here
|
*/

function register_acf_block_types() {

    // register a testimonial block.
    acf_register_block_type(array(
        'name'              => 'example',
        'title'             => __('Example'),
        'description'       => __('An example block.'),
        'render_template'   => get_template_directory() . '/resources/views/blocks/example.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'example', 'quote' ),
        'supports'          => [
            'align' => false,
        ]
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}

