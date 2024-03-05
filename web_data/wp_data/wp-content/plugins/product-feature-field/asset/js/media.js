jQuery(function ($) {
    $('body').on('click', '#' + field_obj.box_id + '_upload', function (e) {
        e.preventDefault();
        let uploader = wp.media({
            title: 'Custom image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        }).on('select', function () {
            let attachment = uploader.state().get('selection').first().toJSON();
            $('#' + field_obj.box_id + '_url').val(attachment.url);
        })
            .open();
    });
});