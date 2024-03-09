<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
// tham khao get_image_tag WP_Image_Editor wp_get_image_editor
function media_link_to_row($url) {
	$output .= '<div class="product-image in-gallery"><picture>';
	$output .= '<img src="'.$url.'" draggable="false" alt="" width="100%" height="100%">';
	$output .= '</picture></div>';
	return $output;
 }

$post_id = get_the_ID();
$media_links = get_post_meta($post_id,'product_media_field',true);
// if (count($media_links) === 0) {
// 	$logo = get_theme_mod( 'custom_logo' );
// 	$image = wp_get_attachment_image_src( $logo , 'full' );
// 	$image_url = $image[0];
// 	$media_links = array($image_url);
// };

?>
<div <?php echo get_block_wrapper_attributes();?>>
<div id="showing-product-picture" class="main-image-div">
    <picture>
        <img class="product-image main-image" src="<?php echo $media_links[0]?>">
    </picture>
</div>
<div id="product-media-gallery" class="product-media-gallery-div">
        <?php 
        foreach ($media_links as $link){
            echo media_link_to_row($link);
            }
        ?>
</div>
</div>
