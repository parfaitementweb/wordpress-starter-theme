<?php

function parf_disable_autosave()
{
    wp_deregister_script('autosave');
}

add_action('wp_print_scripts', 'parf_disable_autosave');