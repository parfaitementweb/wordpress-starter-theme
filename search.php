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

$data = [
    'query' => get_search_query(),
];
$core->render('search', $data);