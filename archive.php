<?php get_header() ?>

<?php if (have_posts()): ?>

    <?php while (have_posts()): the_post() ?>
        {{ the_archive_title('<h1 class="page-title">', '</h1>') }}
        <?php the_content() ?>
        <?php echo get_the_posts_navigation()  ?>
    <?php endwhile ?>

<?php else: ?>
<div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'vaux-brussels') ?>
</div>
<?php echo get_search_form(false) ?>
<?php endif; ?>

<?php get_footer(); ?>