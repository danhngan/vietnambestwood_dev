<?php

/**
 * Plugin Name:       Test Query
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       test-query
 *
 * @package           create-block
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Modifies the static `core/query` block on the server.
 *
 * @since 6.4.0
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      The block instance.
 *
 * @return string Returns the modified output of the query block.
 */
function render_block_test_query($attributes, $content, $block)
{
	error_log(print_r(json_encode($attributes['query']), true));
	if ($attributes['enhancedPagination'] && isset($attributes['queryId'])) {
		$p = new WP_HTML_Tag_Processor($content);
		if ($p->next_tag()) {
			// Add the necessary directives.
			$p->set_attribute('data-wp-interactive', true);
			$p->set_attribute('data-wp-navigation-id', 'query-' . $attributes['queryId']);
			// Use context to send translated strings.
			$p->set_attribute(
				'data-wp-context',
				wp_json_encode(
					array(
						'core' => array(
							'query' => array(
								'loadingText' => __('Loading page, please wait.'),
								'loadedText'  => __('Page Loaded.'),
							),
						),
					),
					JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP
				)
			);
			$content = $p->get_updated_html();

			// Mark the block as interactive.
			$block->block_type->supports['interactivity'] = true;

			// Add a div to announce messages using `aria-live`.
			$last_div_position = strripos($content, '</div>');
			$content           = substr_replace(
				$content,
				'<div
					class="wp-block-query__enhanced-pagination-navigation-announce screen-reader-text"
					aria-live="polite"
					data-wp-text="context.core.query.message"
				></div>
				<div
					class="wp-block-query__enhanced-pagination-animation"
					data-wp-class--start-animation="selectors.core.query.startAnimation"
					data-wp-class--finish-animation="selectors.core.query.finishAnimation"
				></div>',
				$last_div_position,
				0
			);
		}
	}

	$view_asset = 'wp-block-query-view';
	if (!wp_script_is($view_asset)) {
		$script_handles = $block->block_type->view_script_handles;
		// If the script is not needed, and it is still in the `view_script_handles`, remove it.
		if (
			(!$attributes['enhancedPagination'] || !isset($attributes['queryId']))
			&& in_array($view_asset, $script_handles, true)
		) {
			$block->block_type->view_script_handles = array_diff($script_handles, array($view_asset));
		}
		// If the script is needed, but it was previously removed, add it again.
		if ($attributes['enhancedPagination'] && isset($attributes['queryId']) && !in_array($view_asset, $script_handles, true)) {
			$block->block_type->view_script_handles = array_merge($script_handles, array($view_asset));
		}
	}

	$style_asset = 'wp-block-query';
	if (!wp_style_is($style_asset)) {
		$style_handles = $block->block_type->style_handles;
		// If the styles are not needed, and they are still in the `style_handles`, remove them.
		if (
			(!$attributes['enhancedPagination'] || !isset($attributes['queryId']))
			&& in_array($style_asset, $style_handles, true)
		) {
			$block->block_type->style_handles = array_diff($style_handles, array($style_asset));
		}
		// If the styles are needed, but they were previously removed, add them again.
		if ($attributes['enhancedPagination'] && isset($attributes['queryId']) && !in_array($style_asset, $style_handles, true)) {
			$block->block_type->style_handles = array_merge($style_handles, array($style_asset));
		}
	}

	return $content;
}

/**
 * Ensure that the view script has the `wp-interactivity` dependency.
 *
 * @since 6.4.0
 *
 * @global WP_Scripts $wp_scripts
 */
function block_test_query_ensure_interactivity_dependency()
{
	global $wp_scripts;
	if (
		isset($wp_scripts->registered['wp-block-query-view']) &&
		!in_array('wp-interactivity', $wp_scripts->registered['wp-block-query-view']->deps, true)
	) {
		$wp_scripts->registered['wp-block-query-view']->deps[] = 'wp-interactivity';
	}
}

add_action('wp_print_scripts', 'block_test_query_ensure_interactivity_dependency');


/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function test_query_test_query_block_init()
{
	register_block_type_from_metadata(
		__DIR__ . '/build',
		array(
			'render_callback' => 'render_block_test_query',
		)
	);
}
add_action('init', 'test_query_test_query_block_init');
