<?php

/**
 * Disable the emoji's
 */
function parf_remove_generator()
{
    remove_action('wp_head', 'wp_generator');
}

add_action('init', 'parf_remove_generator');
