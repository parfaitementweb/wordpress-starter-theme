<?php

/**
 * Search results page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Include CSS for this query using:
 * $core->include_style('extra.css');
 *
 * Include STYLE css for this query using:
 * $core->include_script('extra.js');
 *
 * Access Request using:
 * $core->request
 **/

$core = new Parfaitement\Core;

/**
 * Render the view
 * MUST BE PLACED AT THE END
 */

$data = [
    'query' => get_search_query(),
];
$core->render('search', $data);