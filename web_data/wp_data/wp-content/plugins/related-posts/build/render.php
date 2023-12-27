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
echo implode(',',WP_Theme_JSON_Resolver::get_style_variations()[0]['settings']['color']['palette']['theme'][0]);


?>
</div>