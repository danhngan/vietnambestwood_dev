<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
// tham khao get_image_tag WP_Image_Editor wp_get_image_editor get_attached_media attachment_url_to_postid

function dnj_slider_render($block_attributes, $content) {
  return '<div class="slideshow-container">
<div>'. $block_attributes . '</div>
<!-- Full-width images with number and caption text -->
<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="/wp-content/uploads/2024/04/img_nature_wide.jpg" style="width:100%"/>
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="/wp-content/uploads/2024/04/img_snow_wide.jpg" style="width:100%"/>
  <div class="text">Caption Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="/wp-content/uploads/2024/04/img_mountains_wide.jpg" style="width:100%"/>
  <div class="text">Caption Three</div>
</div>

<!-- Next and previous buttons -->
<a class="prev">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
<span class="dot" onclick="currentSlide(1)"></span>
<span class="dot" onclick="currentSlide(2)"></span>
<span class="dot" onclick="currentSlide(3)"></span>
</div>';
}