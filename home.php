<?php get_header() ?>

    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>

<?php while (have_posts()): the_post() ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('prose max-w-none'); ?>>
        <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
        <div class="excerpt"><?php the_excerpt(); ?></div>
        <a href="<?php echo get_the_permalink() ?>"><strong><?php echo __('Read More...', 'starter_theme') ?></strong></a>
    </article>

<?php endwhile ?>

<?php get_footer(); ?>