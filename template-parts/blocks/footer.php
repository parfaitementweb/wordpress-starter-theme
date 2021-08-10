<?php

/*
Title: Footer
Description: Footer Block.
Category: common
Icon: admin-comments
Keywords:
Jsx: true
*/

$className = 'footer-block';

// Create id attribute allowing for custom "anchor" value.
// Create class attribute allowing for custom "className" and "align" values.
$id = $className . '-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}

if (! empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$custom_logo_id = get_theme_mod('custom_logo');
$logo = wp_get_attachment_image_src($custom_logo_id, 'full');

?>

<footer id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="footer-container">
        <div class="logo-wrapper">
            <?php if (has_custom_logo()) : ?>
                <img class="logo" src="<?php echo esc_url($logo[0]) ?>" alt="<?php echo get_bloginfo('name') ?>">
            <?php endif; ?>
        </div>
        <?php
        wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'menu_class' => 'primary-navigation',
            'container' => null,
        ])
        ?>
        <div class="inner-blocks">
            <InnerBlocks/>
        </div>
        <p class="copyright">
            <a href="https://parfaitementweb.com" target="_blank">Developed by Parfaitement web</a>
        </p>
    </div>
</footer>
