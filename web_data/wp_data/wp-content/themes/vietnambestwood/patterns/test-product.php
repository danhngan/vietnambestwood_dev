<?php
/**
 * Title: Test product
 * Slug: vietnambestwood/test-product
 * Categories: banner
 * Viewport width: 1400
 */
?>

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|30"},"margin":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--10);margin-bottom:var(--wp--preset--spacing--10)">
<!-- wp:column {"width":"66.66%","backgroundColor":"accent"} -->
<div class="wp-block-column has-accent-background-color has-background" style="flex-basis:66.66%">
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10","left":"var:preset|spacing|10","right":"var:preset|spacing|10"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--10);padding-right:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--10)">
<!-- wp:image {"id":164} -->
<figure class="wp-block-image"><img src="http://local.vietnambestwood.com/wp-content/uploads/2023/12/footer-back-ground-scaled.jpg" alt="" class="wp-image-164"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%","backgroundColor":"accent"} -->
<div class="wp-block-column has-accent-background-color has-background" style="flex-basis:33.33%">
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><p><?php
$post_id = get_the_ID();
$value = get_field( "name" ,$post_id);

echo $value;
echo 'this is test 4';?></p> </div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->