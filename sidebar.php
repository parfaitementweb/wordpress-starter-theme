<?php
/**
 * The sidebar containing the main widget area
 */

if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
    return;
}
?>

<aside id="secondary">
    <?php dynamic_sidebar( 'sidebar-primary' ); ?>
</aside><!-- #secondary -->