<?php

function get_related_posts($post_id){
    $post = get_post($post_id);
	$thumbnail = get_the_post_thumbnail($post->ID, 'thumbnail');
	$res = array(
		'title' => $post->post_title,
		'thumbnail' => $thumbnail
	);
    return $res;
};

?>