<?php
/**
 * The template for displaying the front page.
 */

get_header() ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php while (have_posts()): the_post() ?>
    <?php the_content() ?>
<?php endwhile ?>
</article>

<?php get_footer(); ?>