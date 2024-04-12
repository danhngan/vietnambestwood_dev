<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
// tham khao get_image_tag WP_Image_Editor wp_get_image_editor get_attached_media attachment_url_to_postid

if (!function_exists('get_breadcrumb')) :
	/**
	 * Generate breadcrumbs
	 * @author CodexWorld
	 * @authorURL www.codexworld.com
	 */
	function get_breadcrumb() {
		echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
		if (is_category() || is_single()) {
			echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
			the_category(' &bull; ');
				if (is_single()) {
					echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
					the_title();
				}
		} elseif (is_page()) {
			echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
			echo the_title();
		} elseif (is_search()) {
			echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
			echo '"<em>';
			echo the_search_query();
			echo '</em>"';
		}
	}
        add_action('get_breadcrumb', 'get_breadcrumb');
endif;

?>
<div <?php echo get_block_wrapper_attributes();?>>
<?php
        do_action('get_breadcrumb');
?>
</div>
