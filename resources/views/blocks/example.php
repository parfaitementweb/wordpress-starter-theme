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
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container mx-auto overflow-hidden my-12">
        <div class="flex items-center -mx-4 flex-col md:flex-row">
            <div class="w-full px-4 md:max-w-full ">
                <figure class="flex justify-end">
                    <?php echo wp_get_attachment_image(get_field('image'), 'full', false, [
                        'class' => 'max-w-90 rounded-none shadow-none',
                        'style' => 'height:auto; width:auto;'
                    ] ); ?>
                </figure>
            </div>
            <div class="w-full px-4 overflow-hidden section-content  md:max-w-full pt-6 md:pt-0">
                <h1 class="font-semibold leading-tight leading-none mb-6 text-5xl"><?php echo get_field('title') ?></h1>
                <h2 class="font-light leading-tight mb-6 text-3xl"><?php echo get_field('subtitle') ?></h2>
                <p class="text-base"><?php echo get_field('description') ?></p>
                <?php if( have_rows('buttons') ): ?>
                    <div class="mt-6 flex -mx-2 flex-wrap ">
                        <?php while ( have_rows('buttons') ) : the_row(); ?>
                        <?php $link = get_sub_field('link'); ?>
                            <?php if ($link) : ?>
                            <div class="px-2">
                                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ? $link['target'] : '_self' ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
                            </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>

    <style type="text/css">
        #<?php echo $id; ?> {
            background: <?php echo get_field('background_color') ?>;
        }
    </style>
</div>