<?php

/*
Title: Hero Cover Block
Description: A hero block with cover image, title, subtitle, buttons and InnerBlocks
Jsx: true
*/

$className = 'hero-cover-block';

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

$title = get_field('title');
$subtitle = get_field('subtitle');

$backround_group = get_field('backround_group');

$image = $backround_group['image'] ?? null;
$overlay_color = $backround_group['overlay_color'] ?? null;
$object_position_top = isset($backround_group['focal_point']['top']) ? $backround_group['focal_point']['top'] * 100 : '50';
$object_position_left = isset($backround_group['focal_point']['left']) ? $backround_group['focal_point']['left'] * 100 : '50';

$buttons = get_field('buttons');

$rounded = get_field('rounded');
$full_width = get_field('full_width');
$text_alignment = get_field('text_alignment') ?: 'left';
$min_height = get_field('min_height') ?: 'auto';
?>

<?php if (! $full_width): ?>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <?php endif ?>
    <div class="relative sm:overflow-hidden flex items-center <?php echo ($rounded) ? 'sm:rounded-2xl' : '' ?> " style="min-height: <?php echo $min_height ?>;">
        <div class="absolute inset-0">
            <?php if ($image): ?>
                <img class="h-full w-full object-cover" src="<?php echo $image ?>" style="object-position: <?php echo $object_position_left ?>% <?php echo $object_position_top ?>%">
            <?php endif ?>
            <?php if ($overlay_color): ?>
                <div class="absolute inset-0" style="<?php echo ($image) ? 'opacity:0.1;' : '' ?>background-color: <?php echo $overlay_color ?>;"></div>
            <?php endif ?>
        </div>

        <?php
        switch ($text_alignment) {
            case 'left':
                $alignment = 'text-left justify-start';
                break;
            case 'right':
                $alignment = 'text-right justify-end';
                break;
            default:
                $alignment = 'text-center justify-center';
                break;
        }
        ?>
        <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8 w-full">
            <?php if (isset($title)): ?>
                <h1 class="<?php echo $alignment ?> text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl mb-6">
                    <span class="block text-white"><?php echo $title ?></span>
                </h1>
            <?php endif ?>
            <?php if (isset($subtitle)): ?>
                <p class="<?php echo $alignment ?> text-xl text-gray-200  mb-10">
                    <?php echo $subtitle ?>
                </p>
            <?php endif ?>

            <?php if ($buttons): ?>
                <div class="sm:flex <?php echo $alignment ?> space-y-4 sm:space-y-0 sm:space-x-4">
                    <?php foreach ($buttons as $button): ?>
                        <?php if (isset($button['button_group']['button'])): ?>
                            <?php
                            $button_url = $button['button_group']['button']['url'];
                            $button_title = $button['button_group']['button']['title'];
                            $button_target = $button['button_group']['button']['target'] ?: '_self';
                            $button_style = ($button['button_group']['button_type'] == 'normal') ? '':'btn-outline';
                            ?>
                            <a href="<?php echo $button_url ?>" target="<?php echo $button_target ?>" class="btn btn-lg <?php echo $button_style ?>">
                                <?php echo $button_title ?>
                            </a>
                        <?php endif ?>
                    <?php endforeach; ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <?php if (! $full_width): ?>
</div>
<?php endif ?>
