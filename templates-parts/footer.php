<?php
$template = get_page_by_title('Footer', null, 'templates');
$translated_post_id = icl_object_id($template->ID, 'templates', true);
$translated_content = get_post_field('post_content', $translated_post_id);
echo apply_filters('the_content', $translated_content);
?>
