<?php
// class handles the related posts logic
require_once( 'base.php' );
class RelatedPostsInCategory{
    public $num_of_posts;
    public $current_post;
    public $post_categories;
    private $posts_brief;
    public function __construct($current_post,$num_of_posts,$post_categories){
        $this->num_of_posts = $num_of_posts;
        $this->current_post = $current_post;
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
            $data[] = new PostBrief($post);
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

    public function get_posts_brief(){
        return $this->posts_brief;
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
        if ( ! empty( $this->current_template ) ) {
            $this->current_template_blocks = parse_blocks( $this->current_template[0]->content );
            
        }
        error_log(print_r(json_encode($this->current_template_blocks), true));
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
            // log
            error_log(print_r($block['blockName'], true));
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
        }
        error_log(print_r(json_encode($related_posts_blocks), true)); 
        return $related_posts_blocks;
    }
    public function get_related_blocks_attributes(){
        $attributes = array();
        foreach ($this->related_posts_blocks as $block){
            $attributes[] = $block['attrs'];
        }
        return $attributes;
    }
}

function get_default_attr_value($attr){
    switch ($attr){
        case 'numberOfPosts':
            return 5;
        case 'blockId':
            return '';
        case 'showThumbnail':
            return true;
}
}


function process_template($post){
    // include( 'base.php' );
    $BLOCK_ATTRIBUTES = array(
        'numberOfPosts',
        'blockId',
        'showThumbnail'
    );
    $template = new TemplateParser($post->ID);
	$related_posts_blocks_attributes = $template->get_related_blocks_attributes();
    $results = array();
    foreach($related_posts_blocks_attributes as $block_attributes){
        $result_item = array();
        foreach ($BLOCK_ATTRIBUTES as $attr){
            if ( array_key_exists($attr, $block_attributes ) ) {
                $result_item[$attr] = $block_attributes[$attr];
            }
            else{
                $result_item[$attr] = get_default_attr_value($attr);
            }
        }
        $results[] = $result_item;
    }
    return $results;
}

function get_max_num_of_posts($block_settings){
    return 5;
};

function auto_get_data_related_posts_widgets($current_post){
    $block_settings = process_template($current_post);
    $widgets = array();
    foreach ($block_settings as $block_setting){
        $widgets[$block_setting['blockId']] = $block_setting;
    }
    $max_num_of_posts = get_max_num_of_posts($block_settings);
    $categories = get_the_category($current_post->ID);
    $categories_id = array();
    foreach ($categories as $category){
        $categories_id[] = $category->term_id;
    }
    $related_posts = new RelatedPostsInCategory($current_post,$max_num_of_posts, implode( ',', $categories_id));
    $related_posts_brief_data = $related_posts->get_posts_brief();
    $related_posts_widgets = array();
    foreach (array_keys($widgets) as $block_id){
        $related_posts_widgets[$block_id] = array();
        for ($i = 0; $i < $widgets[$block_id]['numberOfPosts']; $i++){
            $related_posts_widgets[$block_id][] = $related_posts_brief_data[$i];
        }
    }
    return $related_posts_widgets;
}

?>