<?php
/**
 * Plugin Name:       DNJ Slider
 * Description:       DNJ Slider
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.1
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       dnj-slider
 *
 */

require_once 'front/build/render.php';


function slider_init() {
	$block = register_block_type( __DIR__ . '/front/build',array(
        'api_version' => 3,
        'render_callback' => 'dnj_slider_render'
    ) );
}
add_action( 'init', 'slider_init' );
