// any CSS you require will output into a single css file (app.css in this case)
require('../css/admin.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = global.jQuery = require('jquery');
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
});