// any CSS you require will output into a single css file (app.css in this case)
require('../css/admin.scss');
require('codemirror/mode/htmlembedded/htmlembedded');
require('codemirror/theme/monokai.css');
require('@fortawesome/fontawesome-free/css/fontawesome.css');
require('summernote/dist/summernote-bs4.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('bootstrap');
require('codemirror');
require('summernote/dist/summernote-bs4.js');
require('@fortawesome/fontawesome-free/js/all.js');

$(document).on('change', '.custom-file-input', function () {
    let fileName = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
    $(this).parent('.custom-file').find('.custom-file-label').text(fileName);
});

$(document).ready(function() {
   $('.summernote').summernote({
       height: 900,
       codemirror: { // codemirror options
           theme: 'monokai'
       }
   });
});