<?php
/**
 * Plugin Name:       Product Feature Field
 * Description:       Product Feature Fields
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       product-feature-field
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once 'asset/php/classes.php';

$box_id = 'product_feature';
$box_title = 'Product Feature';
$script_path = plugin_dir_url(__FILE__) . 'asset/js/admin.js';

$product_box = new Custom_Meta_Box($box_id, $box_title, $script_path);


add_action( 'add_meta_boxes', [$product_box,'add'] );

// add_action( 'save_post', [$product_box,'save'] );

add_action('admin_enqueue_scripts', [$product_box,'register_scripts']);

add_action( 'wp_ajax_'.$box_id.'_save', [$product_box,'ajax_handler'] );


$media_box_id = 'product_media';
$media_box_title = 'Product media';
$media_script_path = plugin_dir_url(__FILE__) . 'asset/js/media.js';

$media_box = new Custom_Media_Box($media_box_id, $media_box_title, $media_script_path);



add_action( 'add_meta_boxes', [$media_box,'add'] );

// add_action( 'save_post', [$media_box,'save'] );

add_action('admin_enqueue_scripts', [$media_box,'register_scripts']);

add_action( 'wp_ajax_'.$media_box_id.'_save', [$media_box,'ajax_handler'] );