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

function processAddFeature(e) {
    var table = document.getElementById(field_obj.box_id + '_table')
    adRow(table)
}


function getFieldData(table) {
    let rows = table.getElementsByTagName('tr')
    const rowValues = [];

    // Loop through each row
    for (const row of rows) {
        // Get all data cells (assuming class "data-cell")
        const dataKey = row.querySelector('[id^=key]').value;
        const dataVal = row.querySelector('[id^=val]').value;
        rowValues.push({ key: dataKey, val: dataVal })
    }
    return rowValues
}

function sendDataToServer(e, $) {
    const table = document.getElementById(field_obj.box_id + '_table');
    const data = getFieldData(table);
    $.post(field_obj.url,                        // or ajaxurl
        {
            action: field_obj.action,                // POST data, action
            data: data, // POST data, wporg_field_value
            post_ID: jQuery('#post_ID').val()           // The ID of the post currently being edited
        }, function (data) {
            // handle response data
            alert('Data submitted!');
        }
    );
}

(function ($, window, document) {
    'use strict';
    // execute when the DOM is ready
    $(document).ready(function () {
        // js 'change' event triggered on the wporg_field form field
        $('#add_new_' + field_obj.box_id + '_btn').on('click', function (e) {
            console.log('changed');
            processAddFeature(e)
        });
        $('#submit_' + field_obj.box_id + '_btn').on('click', function (e) {
            sendDataToServer(e, $);
        });

    });
}(jQuery, window, document));