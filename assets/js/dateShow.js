$(document).ready(function () {
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
})
;