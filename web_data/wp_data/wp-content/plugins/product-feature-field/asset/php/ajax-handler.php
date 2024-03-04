<?php
// The piece after `wp_ajax_`  matches the action argument being sent in the POST request.

/**
 * Handles my AJAX request.
 */
function custom_box_ajax_handler() {
    // Handle the ajax request here
    if ( array_key_exists( 'wporg_field_value', $_POST ) ) {
        $post_id = (int) $_POST['post_ID'];
        if ( current_user_can( 'edit_post', $post_id ) ) {
            update_post_meta(
                $post_id,
                '_wporg_meta_key',
                $_POST['wporg_field_value']
            );
        }
    }
 
    wp_die(); // All ajax handlers die when finished
}