// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('bootstrap');
require('@fortawesome/fontawesome-free/js/all.js');

let requestHeaders = new Headers();
requestHeaders.append("X-Requested-With", "XMLHttpRequest");

$("#performerModal").on('show.bs.modal', function (event) {
    let performerId = $(event.relatedTarget).data('performer');
    fetch('/performer/' + performerId, {method: "GET", headers: requestHeaders})
        .then(res => res.json())
        .then(result => {
            let birthdayFull = result.birthday;

            let performances = result.performances;
            let performancesString = '<ul>';
            performances.forEach(v => {
                performancesString += '<li>' + v.name + '</li>';
            });
            performancesString += '</ul>';

            let pathPicturePerformers = $('.performer-image').data('path');
            $('.modal-title').text(result.name);
            $('.performer-birthday').text(birthdayFull.split('T')[0]);
            $('.performer-biography').text(result.biography);
            $('.performer-image').attr('src', pathPicturePerformers + result.picture);
            $('.performer-image').attr('alt', result.name);
            $('#country-flag').removeClass();
            $('#country-flag').addClass('border flag-icon flag-icon-' + result.countryIso.toLowerCase());
            $('.performer-country').text(result.countryName);
            $('.performer-performances').html(performancesString);
        })
        .catch(console.error.bind(console));
});

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