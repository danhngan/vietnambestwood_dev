<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<p <?php echo get_block_wrapper_attributes(); ?>>
	<?php esc_html_e( 'Product Feature – hello from a dynamic block!', 'product-feature'); ?>
</p>
<p><?php 
$post_id = get_the_ID();
$value = get_field( "name" ,$post_id);
error_log('ok');
echo $post_id;
echo implode(" ",array_keys(get_post_meta($post_id)));
echo $value;
?></p>
