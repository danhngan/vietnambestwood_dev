<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
// tham khao get_image_tag WP_Image_Editor wp_get_image_editor get_attached_media attachment_url_to_postid
function img_id_to_tag($img_id){
    return get_image_tag( $img_id, '', '', 'center', 'product-image-size' );
}

function media_id_to_row($img_id) {
	$output .= '<div class="product-media in-gallery"><picture>';
	// $output .= '<img src="'.$url.'" draggable="false" alt="" width="100%" height="100%">';
	$output .= img_id_to_tag($img_id);
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

$attachments = attachment_url_to_postid('http://local.vietnambestwood.com/wp-content/uploads/2023/12/footer-back-ground-scaled.jpg');
?>
<div <?php echo get_block_wrapper_attributes();?>>
<div id="showing-product-media" class="product-media main-image-div">
<picture>
        <?php echo img_id_to_tag($media_links[0]); ?>
</picture>
</div>

<div id="product-media-gallery" class="product-media-gallery-div">
        <?php 
        foreach ($media_links as $link){
            echo media_id_to_row($link);
            }
        ?>
</div>
</div>
