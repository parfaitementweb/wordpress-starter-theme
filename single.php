<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */

get_header() ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('prose max-w-none'); ?>>

<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

<?php while (have_posts()): the_post() ?>
    <?php the_content() ?>
<?php endwhile ?>

</article>

<?php get_footer(); ?>