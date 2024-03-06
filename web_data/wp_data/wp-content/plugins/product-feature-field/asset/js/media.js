function dismissMedia(e) {
    console.log('Dismiss an image');
    let target = e.currentTarget;
    let row = target.parentElement.parentElement;
    row.remove();
    alert('Image removed')
}


function getRelativeURLOfFile(url) {
    if (url.startsWith('/')) {
        return url
    }
    else if (url.startsWith('http')) {
        return '/' + url.split('/').slice(3).join('/')
    }
    else {
        return '/' + url.split('/').slice(1).join('/')
    }
}

function addImageRow(url, table, $) {
    var id_img_close_btn = media_obj.box_id + '_';

    var numOfRow = table.getElementsByTagName('tr').length + 1;
    id_img_close_btn += numOfRow + '_close_btn'

    var row = document.createElement('tr');
    var rowHeader = document.createElement('th');
    rowHeader.innerText = media_obj.box_title + ' ' + numOfRow

    var imgCell = document.createElement('td');
    rowHeader.setAttribute('scope', 'row');

    let img = document.createElement('img');
    img.setAttribute('src', url);
    img.setAttribute('draggable', "false");
    img.setAttribute('alt', "");
    img.setAttribute('width', "150");
    img.setAttribute('height', "150");

    imgCell.appendChild(img)

    let btnCell = document.createElement('td');
    let btn = document.createElement('button');
    btn.innerText = 'Dismiss';
    btn.setAttribute('id', id_img_close_btn);
    btn.setAttribute('class', 'dismiss-media-btn btn')

    btnCell.appendChild(btn);

    row.appendChild(rowHeader);
    row.appendChild(imgCell);
    row.appendChild(btnCell);
    table.appendChild(row);

    $('#' + id_img_close_btn).on('click', (e) => dismissMedia(e))

}


function postSelectionProcessing(url) {
    const table = document.getElementById(media_obj.box_id + '_table').getElementsByTagName('tbody')[0];
    addImageRow(url, table, jQuery)

}

(function ($, window, document) {
    'use strict';
    // execute when the DOM is ready

    $(document).ready(function () {
        // js 'change' event triggered on the wporg_field form field
        console.log(media_obj.box_id);
        $('.dismiss-media-btn').on('click', function (e) {
            dismissMedia(e)
        });
        $('#' + media_obj.box_id + '_upload').on('click', function (e) {
            e.preventDefault();
            let uploader = wp.media({
                title: 'Custom image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            }).on('select', function () {
                let attachment = uploader.state().get('selection').first().toJSON();
                postSelectionProcessing(getRelativeURLOfFile(attachment.url));
            })
                .open();
        });

    });
}(jQuery, window, document));