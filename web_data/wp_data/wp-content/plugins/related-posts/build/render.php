<?php
/**
 * Render.php
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * @package block-development-examples
 */
?>
<div class="<?php echo 'related-posts'?>"><?php
require_once __DIR__ . '/core/related-posts.php';
require_once __DIR__ . '/core/base.php';

$current_post = get_post();
// Current post categories
// $categories = get_the_category();
// $categories_id = array();
// foreach ($categories as $category){
// 	$categories_id[] = $category->term_id;
// }
// $categories_id = implode(',', $categories_id);
// echo implode(',', get_post_class());
$post_ID = $current_post->ID;
$related_posts = new RelatedPost( $current_post );
$related_posts->render();
$theme_array = WP_Theme_JSON_Resolver::get_theme_data()->get_data();
foreach ($theme_array['settings']['color']['palette'] as $color){
    echo implode(',',$color);
};
$template_slug = get_page_template_slug( $post_ID );

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

    $what_post_type = get_post_type( $post_ID );
    switch ( $what_post_type ) {
        case 'page':
            $template_slug = $page_slug;
            break;
        default:
            $template_slug = $post_slug;
            break;
    }
}

$current_template = get_block_templates( array( 'slug__in' => array( $template_slug ) ) );

if ( ! empty( $current_template ) ) {
    $template_blocks    = parse_blocks( $current_template[0]->content );
    $post_content_block = wp_get_first_block( $template_blocks, 'create-block/related-posts' );

    if ( isset( $post_content_block['attrs'] ) ) {
        echo json_encode($post_content_block['attrs']);
    }
}

echo null;
?>
</div>