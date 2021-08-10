<?php
$template = get_page_by_title('Footer', null, 'parf_templates');
if ($template) {
    $translated_post_id = apply_filters( 'wpml_object_id', $template->ID, 'parf_templates', true);
    $translated_content = get_post_field('post_content', $translated_post_id);
    echo apply_filters('the_content', $translated_content);
}
?>