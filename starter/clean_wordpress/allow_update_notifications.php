<?php
/*
Plugin Name: Allow Update Notifications
Plugin URI: https://gist.github.com/jaydansand/2e41490a8b040a199db4
Description: WordPress plugin to allow module/theme/core update notifications even when DISALLOW_FILE_MODS is TRUE.
Version: 1.0
Author: Jay Dansand, Technology Services, Lawrence University
Author URI: https://gist.github.com/jaydansand
*/
/* Copyright 2014 Lawrence University
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

function wp_allow_update_notifications_filter_map_meta_cap($caps, $cap, $user_id, $args)
{
    switch ($cap) {
        case 'update_plugins':
        case 'update_themes':
        case 'update_core':
            // WordPress disables these capabilities if DISALLOW_FILE_MODS is TRUE.
            // Override that here (so that update notifications still work for network
            // admins).
            if (defined('DISALLOW_FILE_MODS') && DISALLOW_FILE_MODS) {
                // Act only in the case where WordPress denied the capability based on
                // DISALLOW_FILE_MODS.
                // Remove the previously-set "do_not_allow".
                $caps = array_diff($caps, array('do_not_allow'));
                // Proceed with the checks that WordPress would have made if it hadn't
                // stopped at DISALLOW_FILE_MODS.
                if (is_multisite() && ! is_super_admin($user_id)) {
                    $caps[] = 'do_not_allow';
                } else {
                    $caps[] = $cap;
                }
            }
            break;
        default:
            break;
    }

    return $caps;
}

add_filter('map_meta_cap', 'wp_allow_update_notifications_filter_map_meta_cap', 100, 4);
