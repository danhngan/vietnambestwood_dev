<?php
class RelatedPostClassName {
    public $widget_class = 'related-post-widget-vnbw';
    public $article_class = 'related-post-article-vnbw';
    public $title_class = 'related-post-title-vnbw';
    public $post_title_class = 'related-post-post-title-vnbw';
    public $thumbnail_class = 'related-post-thumbnail-vnbw';
    public $thumbnail_wrapper_class = 'related-post-thumbnail-wrapper-vnbw';
}?>

<?php 
// class StyleHandler{
//     public function __construct(){
        
//     }

//     public function insert_to_head(){
//         if (!function_exists('register_related_posts_style')) {
//             // if not, create one
//             function register_related_posts_style() {
//                 // Register styles in WordPress
//                 wp_register_style('prefix-basic-css', get_template_directory_uri(). '/css/basic-style.css');
   
//                 // Register styles in WordPress
//                 wp_register_style('first-css', get_template_directory_uri(). '/css/first-style.css');
   
//                 // Register styles in WordPress
//                 wp_register_style('second-css', get_template_directory_uri(). '/css/second-style.css');
   
//         // TODO check if post type
//         wp_enqueue_style('second-css'); 
   
//        }
//     }
//     add_action('wp_enqueue_scripts', 'register_related_posts_style');
//     }
// }
?>


<?php
class RelatedPost {
    public $post;
    public $show_thumbnail;
    public $ID;
    public $post_title;
    private $class_name_instance;
    public function __construct($post, $show_thumbnail = true){
        $this->post = $post;
        $this->show_thumbnail = $show_thumbnail;
        $this->ID = $post->ID;
        $this->post_title = $post->post_title;
        $this->class_name_instance = new RelatedPostClassName();
    }
    public function get_html(){
        $response = '<div class="'.apply_filters('related_post_article_class',RelatedPostClassName::$article_class).'">';
        $response .= '</div>';
        return $response;
    }

    public function render(){ ?>
        <article class="<?php echo apply_filters('related_post_article_class',$this->class_name_instance->article_class);?>">
        <div class="<?php echo apply_filters('related_post_thumbnail_class',$this->class_name_instance->thumbnail_class);?>">
        <a class="<?php echo apply_filters('related_post_thumbnail_class',$this->class_name_instance->thumbnail_class);?>" href="<?php echo get_permalink($this->ID);?>">
        <picture>
            <?php echo $this->get_post_thumbnail();?>
        </picture>
        </a>
        </div>
        <div class="<?php echo apply_filters('related_post_post_title_class',$this->class_name_instance->post_title_class);?>">
        <a class="<?php echo apply_filters('related_post_post_title_class',$this->class_name_instance->post_title_class);?>" href="<?php echo get_permalink($this->ID);?>">
        <?php echo $this->post_title;?>
        </a>
        </div>
        </article>
        <?php
    }

    private function get_post_thumbnail(){
        if (has_post_thumbnail($this->post->ID)){
            return get_the_post_thumbnail($this->post->ID, 'thumbnail');
        }
        return get_the_post_thumbnail($this->post->ID, 'thumbnail');
    }

}
?>

