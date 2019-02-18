<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/page-slug.php
 * (you'll want to duplicate this file and save to the above path)
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
$core->render('page', $data);