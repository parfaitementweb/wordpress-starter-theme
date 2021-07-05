<?php get_header() ?>

<?php get_search_form(); ?>


    <h1><?php _e('Search Results for: <span>' . get_search_query() . '</span>', 'vaux-brussels') ?></h1>

<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post() ?>
        <?php the_title() ?>
    <?php endwhile ?>
<?php else: ?>
    <div class="alert alert-warning">
        <?php _e('Sorry, no results were found.', 'vaux-brussels') ?>
    </div>
<?php endif ?>
<?php wp_reset_query() ?>

<?php get_footer() ?>