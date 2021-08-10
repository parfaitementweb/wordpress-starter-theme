<?php

add_filter('wp_revisions_to_keep', 'parf_revisions_to_keep', 10, 2);

function parf_revisions_to_keep($num, $post)
{
    return 20;
}