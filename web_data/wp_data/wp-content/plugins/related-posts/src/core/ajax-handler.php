<?php
require_once('base.php');
require_once('related-posts.php');


function get_related_posts($post_id){
    $current_post = get_post($post_id);
	$current_template = new TemplateParser($current_post->ID);
	$block_settings = $current_template->get_blocks_attributes();
    return array(
        'post_id' => $post_id,
        'post_title' => $current_post->post_title,
        'thumbnail_tag' => '',
        'widget_id' => ''
    );
};

?>