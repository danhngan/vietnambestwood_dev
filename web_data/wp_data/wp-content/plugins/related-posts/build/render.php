<?php
/**
 * Render.php
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * @package block-development-examples
 */
?>
<div><?php
require __DIR__ . '/core/related-posts.php';
require __DIR__ . '/core/base.php';

$current_post = get_post();
// Current post categories
// $categories = get_the_category();
// $categories_id = array();
// foreach ($categories as $category){
// 	$categories_id[] = $category->term_id;
// }
// $categories_id = implode(',', $categories_id);


// echo implode(',', get_post_class());
$related_posts = new RelatedPost( $current_post );
$related_posts->render();
$theme_array = WP_Theme_JSON_Resolver::get_theme_data()->get_data();
foreach ($theme_array['settings']['color']['palette'] as $color){
    echo implode(',',$color);
};
// get type of object
?>
</div>