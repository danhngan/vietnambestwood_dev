<?php

/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php esc_html_e('Test Query – hello from a dynamic block!', 'test-query'); ?>
	<div>
		<?php echo render_block($block->inner_blocks->current()->parsed_block); ?>
		<?php echo gettype($block->inner_blocks->next()); ?>
		this is test
	</div>
</div>