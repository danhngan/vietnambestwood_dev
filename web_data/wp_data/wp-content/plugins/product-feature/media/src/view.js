/**
 * Use this file for JavaScript code that you want to run in the front-end
 * on posts/pages that contain this block.
 *
 * When this file is defined as the value of the `viewScript` property
 * in `block.json` it will be enqueued on the front end of the site.
 *
 * Example:
 *
 * ```js
 * {
 *   "viewScript": "file:./view.js"
 * }
 * ```
 *
 * If you're not making any changes to this file because your project doesn't need any
 * JavaScript running in the front-end, then you should delete this file and remove
 * the `viewScript` property from `block.json`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

/* eslint-disable no-console */
/* eslint-enable no-console */

(function viewImage($, d, w) {
    $(document).ready(() => {
        $('.product-media.in-gallery').first().addClass('highlight');
        $('.product-media.in-gallery').on('click', function (e) {
            $('.product-media.in-gallery.highlight').removeClass('highlight');
            const element = $(e.target);
            element.parent().parent().addClass('highlight');
            const src = element.attr('src');
            var srcset = element.attr('srcset');
            if (!srcset) {
                srcset = ''
            }
            $('#showing-product-media img').attr("src", src);
            $('#showing-product-media img').attr("srcset", srcset);
        })
    })
})(jQuery, document, window)
