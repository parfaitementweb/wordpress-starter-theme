<?php

/**
 * Example Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'example-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'example';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text = get_field('text') ?: 'Your text here...';
$description = get_field('description') ?: 'lorem ipsum';
$image = get_field('image') ?: 295;
$background_color = get_field('background_color');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> flex justify-center items-center">
    <blockquote class="example-blockquote">
        <div class="mr-5"><?php echo $text; ?></div>
        <div class=""><?php echo $description; ?></div>
    </blockquote>
    <div class="example-image">
        <?php echo wp_get_attachment_image( $image, 'full' ); ?>
    </div>
        <style type="text/css">
        #<?php echo $id; ?> {
            background: <?php echo $background_color; ?>;
        }
    </style>
</div>