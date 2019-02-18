<?php

/**
 * The template for displaying 404 pages (Not Found)
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

$data = [];
$core->render('404', $data);