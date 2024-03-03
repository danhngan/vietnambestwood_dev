/*jslint browser: true, plusplus: true */
function adRow(table) {
    let id_prefix = field_obj.box_id + '_';

    var numOfRow = table.getElementsByTagName('tr').length + 1;

    var row = document.createElement('tr');
    var rowHeader = document.createElement('th');
    rowHeader.innerText = field_obj.box_title + ' ' + numOfRow

    var rowDataKey = document.createElement('td');
    var rowDataVal = document.createElement('td');
    rowHeader.setAttribute('scope', 'row');

    var newLabelKey = document.createElement('label');
    newLabelKey.setAttribute('for', 'key_' + id_prefix + numOfRow);
    newLabelKey.innerText = 'Key: ';
    var newInputKey = document.createElement('input');
    newInputKey.setAttribute('type', 'text');
    newInputKey.setAttribute('id', 'key_' + id_prefix + numOfRow);
    newInputKey.setAttribute('name', 'key_' + id_prefix + numOfRow);
    newInputKey.setAttribute('value', '');
    rowDataKey.appendChild(newLabelKey);
    rowDataKey.appendChild(newInputKey);


    var newLabelVal = document.createElement('label');
    newLabelVal.setAttribute('for', 'val_' + id_prefix + numOfRow);
    newLabelVal.innerText = 'Value: ';
    var newInputVal = document.createElement('input');
    newInputVal.setAttribute('type', 'text');
    newInputVal.setAttribute('id', 'val_' + id_prefix + numOfRow);
    newInputVal.setAttribute('name', 'val_' + id_prefix + numOfRow);
    newInputVal.setAttribute('value', '');
    rowDataVal.appendChild(newLabelVal);
    rowDataVal.appendChild(newInputVal);
    row.appendChild(rowHeader);
    row.appendChild(rowDataKey);
    row.appendChild(rowDataVal);
    table.appendChild(row)

}

function processProductKeyValFeature(e) {
    var table = document.getElementById(field_obj.box_id + '_table')
    adRow(table)
}


(function ($, window, document) {
    'use strict';
    // execute when the DOM is ready
    $(document).ready(function () {
        // js 'change' event triggered on the wporg_field form field
        $('#add_new_' + field_obj.box_id + '_btn').on('click', function (e) {
            console.log('changed');
            processProductKeyValFeature(e)
        });

    });
}(jQuery, window, document));