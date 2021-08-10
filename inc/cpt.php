<?php

function register_custom_post_types()
{

    /**
     * Post Type: Events.
     */

    $labels = [
        "name" => "Events",
        "singular_name" => "Event",
        "menu_name" => "Events",
        "all_items" => "All Events",
        "add_new" => "Add new",
        "add_new_item" => "Add new Event",
        "edit_item" => "Edit Event",
        "new_item" => "New Event",
        "view_item" => "View Event",
        "view_items" => "View Events",
        "search_items" => "Search Events",
        "not_found" => "No Events found",
        "not_found_in_trash" => "No Events found in trash",
        "parent" => "Parent Event:",
        "featured_image" => "Featured image for this Event",
        "set_featured_image" => "Set featured image for this Event",
        "remove_featured_image" => "Remove featured image for this Event",
        "use_featured_image" => "Use as featured image for this Event",
        "archives" => "Event archives",
        "insert_into_item" => "Insert into Event",
        "uploaded_to_this_item" => "Upload to this Event",
        "filter_items_list" => "Filter Events list",
        "items_list_navigation" => "Events list navigation",
        "items_list" => "Events list",
        "attributes" => "Events attributes",
        "name_admin_bar" => "Event",
        "item_published" => "Event published",
        "item_published_privately" => "Event published privately.",
        "item_reverted_to_draft" => "Event reverted to draft.",
        "item_scheduled" => "Event scheduled",
        "item_updated" => "Event updated.",
        "parent_item_colon" => "Parent Event:",
    ];

    $args = [
        "label" => "Events",
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "events", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "editor", "thumbnail"],
    ];

    register_post_type("events", $args);

    /**
     * Post Type: Templates.
     */

    $labels = [
        "name" => "Templates",
        "singular_name" => "Template",
        "menu_name" => "Templates",
        "all_items" => "All Templates",
        "add_new" => "Add new",
        "add_new_item" => "Add new Template",
        "edit_item" => "Edit Template",
        "new_item" => "New Template",
        "view_item" => "View Template",
        "view_items" => "View Templates",
        "search_items" => "Search Templates",
        "not_found" => "No Templates found",
        "not_found_in_trash" => "No Templates found in trash",
        "parent" => "Parent Template:",
        "featured_image" => "Featured image for this Template",
        "set_featured_image" => "Set featured image for this Template",
        "remove_featured_image" => "Remove featured image for this Template",
        "use_featured_image" => "Use as featured image for this Template",
        "archives" => "Template archives",
        "insert_into_item" => "Insert into Template",
        "uploaded_to_this_item" => "Upload to this Template",
        "filter_items_list" => "Filter Templates list",
        "items_list_navigation" => "Templates list navigation",
        "items_list" => "Templates list",
        "attributes" => "Templates attributes",
        "name_admin_bar" => "Template",
        "item_published" => "Template published",
        "item_published_privately" => "Template published privately.",
        "item_reverted_to_draft" => "Template reverted to draft.",
        "item_scheduled" => "Template scheduled",
        "item_updated" => "Template updated.",
        "parent_item_colon" => "Parent Template:",
    ];

    $args = [
        "label" => "Templates",
        "labels" => $labels,
        "description" => "",
        "public" => false,
        "publicly_queryable" => false,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => false,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => false,
        "query_var" => true,
        "supports" => ["title", "editor"],
        'menu_icon' => 'dashicons-editor-kitchensink'
    ];

    register_post_type("parf_templates", $args);
}

add_action('init', 'register_custom_post_types');

//function disable_gutenberg_for_post_types($current_status, $post_type)
//{
//    $disabled_post_types = array('category');
//
//    if (in_array($post_type, $disabled_post_types, true)) {
//        $current_status = false;
//    }
//
//    return $current_status;
//}
//
//add_filter('use_block_editor_for_post_type', 'disable_gutenberg_for_post_types', 10, 2);