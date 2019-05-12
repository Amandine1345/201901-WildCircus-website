// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = global.$ = require('jquery');
require('bootstrap');
require('leaflet');
require('@fortawesome/fontawesome-free/js/all.js');

$('#form_contact_us').submit(function (event) {
    let emailData = $(this).serialize();
    $('#form_contact_us button').addClass('d-none');
    $('.sending-in-progress').removeClass('d-none');
    $.post('/contact/sendEmail', emailData, function (data) {
        document.getElementById("form_contact_us").reset();
        $('.sending-in-progress').addClass('d-none');
        $('.message-sent').removeClass('d-none');
    })
        .fail(function () {
            $('.sending-in-progress').addClass('d-none');
            $('.message-sent-error').removeClass('d-none');
        });

    event.preventDefault();
});