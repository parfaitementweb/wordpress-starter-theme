<?php

add_filter('show_admin_bar', '__return_false');

function parf_hideAdminBar()
{
    echo '<style type="text/css">.show-admin-bar { display: none; }</style>';
}

add_action('admin_print_scripts-profile.php', 'parf_hideAdminBar');