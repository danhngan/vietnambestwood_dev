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
class PostBrief {
    public $post;
    public $show_thumbnail;
    public $id;
    public $link;
    public $post_title;
    public function __construct($post, $show_thumbnail = true){
        $this->post = $post;
        $this->show_thumbnail = $show_thumbnail;
        $this->id = $post->id;
        $this->post_title = $post->post_title;
        $this->link = get_permalink($this->id);
    }
    public function get_data(){
        $data = array();
        $data['id'] = $this->id;
        $data['post_title'] = $this->post_title;
        if ($this->show_thumbnail){
            $data['thumbnail'] = $this->_get_post_thumbnail();
        }
        else{
            $data['thumbnail'] = '';
        }
        $data['link'] = $this->link;
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