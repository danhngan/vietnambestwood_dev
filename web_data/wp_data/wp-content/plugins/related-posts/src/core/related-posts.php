<?php
// class handles the related posts logic
class RelatedPostsInCategory{
    public $num_of_posts;
    public $post_categories;

    private $posts;
    public function __construct($num_of_posts, $post_categories){
        $this->num_of_posts = $num_of_posts;
        $this->post_categories = $post_categories;
    }
    public function get_related_posts(){
        // get posts in post_categories
        $args = array(
            'category' => $this->post_categories,
            'posts_per_page' => $this->num_of_posts,
            'orderby' => 'post_date',
            'order' => 'DESC',
        );
        $related_posts = get_posts($args);
        return $related_posts;
    }

    public function display_related_posts(){
        $this->posts = $this->get_related_posts();
        foreach($this->posts as $post){
            echo '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
        }
    }

    public function display_post_thumbnails(){
        foreach ($this->posts as $related_post){
        if (has_post_thumbnail($related_post->ID)){
            echo get_the_post_thumbnail($related_post->ID, 'thumbnail');
        }}
}

}
?>