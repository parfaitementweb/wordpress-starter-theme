<?php

add_action('wp_footer', function () {
    wp_dequeue_script('wp-embed');
});