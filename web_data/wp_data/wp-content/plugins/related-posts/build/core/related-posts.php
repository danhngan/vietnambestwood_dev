<?php
// class handles the related posts logic
require_once( 'base.php' );
// Current post categories
// $categories = get_the_category();
// $categories_id = array();
// foreach ($categories as $category){
// 	$categories_id[] = $category->term_id;
// }
// $categories_id = implode(',', $categories_id);
// echo implode(',', get_post_class());
class RelatedPostsInCategory{
    public $num_of_posts;
    public $post_categories;
    private $posts_brief;
    public function __construct($num_of_posts, $post_categories){
        $this->num_of_posts = $num_of_posts;
        $this->post_categories = $post_categories;
        $this->posts_brief = $this->_get_related_posts_brief();
    }
    /*
    * get posts in post_categories and
    * @return array of PostBrief
    */
    private function _get_related_posts_brief() : array {
        // get posts in post_categories
        $args = array(
            'category' => $this->post_categories,
            'posts_per_page' => $this->num_of_posts,
            'orderby' => 'post_date',
            'order' => 'DESC',
        );
        
        $posts = get_posts($args);
        $data = array();
        foreach ( $posts as $post) {
            $data = new PostBrief($post);
        }
        return $data;
    }

    public function get_presentable_posts_brief(){
        $data = array();
        foreach ($this->posts_brief as $post_brief) {
            $data[] = $post_brief->get_data();
        }
        return $data;
    }
}


class TemplateParser{
    private $related_posts_blocks;
    public $current_template;
    public $current_template_blocks;
    public $post_id;
    public function __construct($post_id){
        $this->post_id = $post_id;
        $this->current_template = $this->_get_template();
        $this->related_posts_blocks = array();
        if ( ! empty( $current_template ) ) {
            $this->current_template_blocks = parse_blocks( $this->current_template[0]->content );
            
        }
        $this->related_posts_blocks = $this->_get_related_posts_blocks($this->current_template_blocks, 'create-block/related-posts');
    }

    private function _get_template(){
        $template_slug = get_page_template_slug( $this->post_id );

        if ( ! $template_slug ) {
            $post_slug      = 'singular';
            $page_slug      = 'singular';
            $template_types = get_block_templates();

            foreach ( $template_types as $template_type ) {
                if ( 'page' === $template_type->slug ) {
                    $page_slug = 'page';
                }
                if ( 'single' === $template_type->slug ) {
                    $post_slug = 'single';
                }
            }

            $what_post_type = get_post_type( $this->post_id );
            switch ( $what_post_type ) {
                case 'page':
                    $template_slug = $page_slug;
                    break;
                default:
                    $template_slug = $post_slug;
                    break;
            }
        }

        return get_block_templates( array( 'slug__in' => array( $template_slug ) ) );
    }

    private function _get_related_posts_blocks($blocks, $block_name){
        $related_posts_blocks = array();
        foreach ($blocks as $block){
            if ($block['blockName'] === $block_name){
                $related_posts_blocks[] = $block;
            }
            if ( ! empty( $block['innerBlocks'] ) ) {
                $found_blocks = $this->_get_related_posts_blocks( $block['innerBlocks'], $block_name );
                if ( ! empty( $found_blocks ) ) {
                    foreach ( $found_blocks as $found_block_item ) {
                        $related_posts_blocks[] = $found_block_item;
                    }
                }
            }            
        if ( isset( $related_posts_blocks ) ) {
            echo json_encode($related_posts_blocks);
            return $related_posts_blocks;
        } else {
            return false;
        }
    }
    }
    public function get_blocks_attributes(){
        $attributes = array();
        foreach ($this->related_posts_blocks as $block){
            $attributes[] = $block['attrs'];
        }
        return $attributes;
    }

}
?>