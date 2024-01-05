<?php
function get_theme_settings(){
$theme_array = WP_Theme_JSON_Resolver::get_theme_data()->get_data();
// foreach ($theme_array['settings']['color']['palette'] as $color){
//     echo implode(',',$color);
// }
return $theme_array;
};
// class RelatedPostClassName {
//     public $widget_class = 'related-post-widget-vnbw';
//     public $article_class = 'related-post-article-vnbw';
//     public $title_class = 'related-post-title-vnbw';
//     public $post_title_class = 'related-post-post-title-vnbw';
//     public $thumbnail_class = 'related-post-thumbnail-vnbw';
//     public $thumbnail_wrapper_class = 'related-post-thumbnail-wrapper-vnbw';
// }

$BLOCK_ATTRIBUTES = array('numberOfPosts', 'showThumbnail', 'blockId');
class PostBrief {
    public $post;
    public $show_thumbnail;
    public $id;
    public $url;
    public $title;
    public $thumbnail_tag;
    public function __construct($post, $show_thumbnail = true){
        $this->post = $post;
        $this->show_thumbnail = $show_thumbnail;
        $this->id = $post->ID;
        $this->title = $post->post_title;
        $this->url = get_permalink($this->id);
        $this->thumbnail_tag = $this->_get_post_thumbnail();
    }
    public function get_data(){
        $data = array();
        $data['id'] = $this->id;
        $data['title'] = $this->title;
        if ($this->show_thumbnail){
            $data['thumbnail_tag'] = $this->thumbnail_tag;
        }
        else{
            $data['thumbnail_tag'] = '';
        }
        $data['url'] = $this->url;
        return $data;
    }
    private function _get_post_thumbnail(){
        if (has_post_thumbnail($this->id)){
            return get_the_post_thumbnail($this->id, 'thumbnail');
        }
        return $this->_set_get_default_thumbnail();
    }

    private function _set_get_default_thumbnail(){
        // HARD CODED
        $default_thumbnail_id = get_post_thumbnail_id(1);
        set_post_thumbnail($this->post,$default_thumbnail_id);
        return get_the_post_thumbnail($this->id, 'thumbnail');
    }
}?>