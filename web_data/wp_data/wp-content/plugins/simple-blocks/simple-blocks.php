<?php
/**
 * Plugin Name:       Simple blocks
 * Description:       Simple blocks: breadcrumb
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.0.1
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       simple-blocks
 *
 */

function simple_blocks_init() {
	$block = register_block_type( __DIR__ . '/breadcrumb/build');
}
add_action( 'init', 'simple_blocks_init' );