<!doctype html>
<html <?php language_attributes(); ?>>

<?php get_template_part('template-parts/head') ?>

<body <?php body_class() ?>>
<?php wp_body_open(); ?>
<?php get_template_part('template-parts/header') ?>

<div class="wrap with-padding">
    <a class="screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'starter_theme' ); ?></a>
        <main id="primary" role="main">
