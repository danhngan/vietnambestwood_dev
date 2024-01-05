<?php
/**
 * Render.php
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * @package block-development-examples
 */
?>
<?php
$class=rtrim(get_block_wrapper_attributes(),'"').' related-posts"';
$class = trim( $class );
$block_id = $attributes['blockId'];
?>
<div <?php echo $class; ?> blid="<?php echo $block_id; ?>">
this is test
</div>