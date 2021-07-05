<?php

function parf_remove_page_attribute_meta_box()
{
    $screen = get_current_screen();

    if (is_admin() && ($screen->id == 'page')) {
        global $post;
        $current_page_id = $post->ID;
        $front_page_id = get_option('page_on_front');

        if ($current_page_id == $front_page_id) {
            remove_meta_box('pageparentdiv', 'page', 'normal');
            remove_meta_box('pageparentdiv', 'page', 'side');
            remove_meta_box('pageparentdiv', 'page', 'advanced');
        }
    }
}

add_action('admin_notices', 'parf_remove_page_attribute_meta_box');