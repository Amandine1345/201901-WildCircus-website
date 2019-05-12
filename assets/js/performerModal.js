// GET PERFORMER'S DATA
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