<?php
require_once('base.php');
require_once('related-posts.php');




function get_related_posts($post_id){
    $current_post = get_post($post_id);
	$widgets_results = auto_get_data_related_posts_widgets($current_post);
	$results = array();
    foreach(array_keys($widgets_results) as $widget_id){
        if(count($widgets_results[$widget_id]) == 0){
            continue;
        }
        $results[$widget_id] = array();
        foreach($widgets_results[$widget_id] as $related_post){
            $results[$widget_id][] = array(
                'url' => $related_post->url,
                'title' => $related_post->title,
                'thumbnail_tag' => $related_post->thumbnail_tag,
                'widget_id' => $widget_id
            );
        }
    }
    return $results;
};

?>