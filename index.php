<?php get_header() ?>

<?php if (have_posts()): ?>

    <?php while (have_posts()): the_post() ?>
        <?php the_content() ?>
    <?php endwhile ?>

<?php else: ?>
    <div class="alert alert-warning">
        <?php _e('Sorry, no results were found.', 'vaux-brussels') ?>
    </div>
    <?php echo get_search_form(false) ?>
<?php endif; ?>

<?php get_footer(); ?>