<?php
/**
 * Plugin Name:       Related Posts
 * Description:       Display your site&#39;s copyright date.
 * Version:           0.1.0
 * Requires at least: 6.2
 * Requires PHP:      7.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       related-posts
 *
 * @package           create-block
 */
require_once (__DIR__.'/build/core/ajax-handler.php');


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
$related_posts_view_script = 'related_posts_view_script';
function related_posts_related_posts_init() {
	global $related_posts_view_script;
	$block = register_block_type( __DIR__ . '/build');
	$related_posts_view_script = $block->view_script_handles[0];
	$related_posts_nonce = wp_create_nonce('related_posts_widget_nonce');
	wp_localize_script($related_posts_view_script,'related_posts_ajax_obj',
				array( 'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'=>$related_posts_nonce));
}
add_action( 'init', 'related_posts_related_posts_init' );

if ( ! wp_script_is( 'jquery', 'enqueued' )) {
	wp_enqueue_script( 'jquery' );
}

function request_related_posts_handle(){
	check_ajax_referer('related_posts_widget_nonce');
	$post_id = $_POST['post_id'];
	$blocks_ids = $_POST['blocks_ids'];
	$res = get_related_posts($post_id);
	wp_send_json($res);
}
add_action('wp_ajax_nopriv_request_related_posts', 'request_related_posts_handle');
add_action('wp_ajax_request_related_posts', 'request_related_posts_handle');