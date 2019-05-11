// any CSS you require will output into a single css file (app.css in this case)
require('../css/admin.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = global.jQuery = require('jquery');
require('jquery-ui-bundle');
global.moment = require('moment');
require('bootstrap');
require('codemirror');
require('summernote/dist/summernote-bs4.js');
require('@fortawesome/fontawesome-free/js/all.js');
require('tempusdominus-bootstrap-4');

$(document).on('change', '.custom-file-input', function () {
    let fileName = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
    $(this).parent('.custom-file').find('.custom-file-label').text(fileName);
});

$(document).ready(function () {
    $('.summernote').summernote({
        height: 900,
        codemirror: { // codemirror options
            theme: 'monokai'
        }
    });

    $('.datetimepicker').datetimepicker({
        inline: true,
        sideBySide: true,
    });

    let responses = null;

    $('.city-selector').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: 'https://geo.api.gouv.fr/communes?nom=' + request.term + '&limit=10&fields=centre,departement&boost=population',
                dataType: 'json',
                method: 'GET'
            })
                .done(function (data) {
                    if (data.length > 0) {
                        responses = data;
                        response($.map(data, function (object) {
                            return object.nom.toUpperCase() + ' (' + object.departement.code + ' - ' + object.departement.nom + ')';
                        }));
                    }
                })
                .fail(function () {
                    console.log('Error: API connection');
                });
        },
        select: function (event, ui) {
            let selectedValue = ui.item.value;
            let city = selectedValue.substring(0, selectedValue.indexOf('(') - 1).trim();
            let codeAndDepartment = selectedValue.substring(selectedValue.indexOf('(') + 1, selectedValue.indexOf(')'));
            let code = codeAndDepartment.substring(0, codeAndDepartment.indexOf('-') - 1).trim();

            responses.forEach(function (row) {
                if (row.nom.toUpperCase() === city && row.departement.code === code) {
                    $('#date_show_longitude').val(row.centre.coordinates[0]);
                    $('#date_show_latitude').val(row.centre.coordinates[1]);
                }
            });

        },
        change: function (event, ui) {
            if (ui.item == null) {
                $('.city-selector').val('');
                $('#date_show_longitude').val('');
                $('#date_show_latitude').val('');
            }
        },
        minLength: 2
    });
});