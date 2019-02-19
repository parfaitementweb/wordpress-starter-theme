<?php

/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
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

$data = [];
$core->render('archive', $data);