<?php
/**
 * Plugin Name:       Product Feature
 * Description:       Product Feature
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.1
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       product-feature
 *
 */

function product_media_init() {
	$block = register_block_type( __DIR__ . '/media/build');
}
add_action( 'init', 'product_media_init' );

function product_feature_init() {
	$block = register_block_type( __DIR__ . '/feature/build');
}
add_action( 'init', 'product_feature_init' );