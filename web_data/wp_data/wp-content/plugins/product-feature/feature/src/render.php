<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
// tham khao get_image_tag WP_Image_Editor wp_get_image_editor get_attached_media attachment_url_to_postid
?>
<div <?php echo get_block_wrapper_attributes();?>>
<div id="product-feature-noc" class="product-feature">
        <p><?php 
        $value = get_field( "product-feature" );
        echo $value;
        ?></p>
</div>
</div>
