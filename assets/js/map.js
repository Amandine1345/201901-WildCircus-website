// if #map exists
if ($('#map').length > 0) {
    let mapData = document.querySelector('#map');
    let shows = JSON.parse(mapData.dataset.shows);

    // default position = France center
    let defaultLatitude = 46.227638;
    let defaultLongitude = 2.213749;

    if (shows.length > 0) {
        // Initialisation map
        let mappy = L.map('map').setView([defaultLatitude, defaultLongitude], 5);
        let pointer = L.icon({
            'iconUrl': '../favicon/favicon-16x16.png',
            'iconSize': [16, 16]
        });
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            // Il est toujours bien de laisser le lien vers la source des données
            attribution: 'data © <a href="//osm.org/copyright">OpenStreetMap</a>contributors / Licence: ODbL - render <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 20
        }).addTo(mappy);

        // Place markers in map
        for (let dateShow of shows) {
            let marker = L.marker([dateShow.latitude, dateShow.longitude], {icon: pointer}).addTo(mappy);
            // popin on click
            let options = {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
                hour: "numeric",
                minute: "numeric"
            };
            let formatedDateShow = new Intl.DateTimeFormat("en-US", options).format(new Date(dateShow.date.date));
            let popupContent = "<p><strong>" + dateShow.city + "</strong><br/>" + formatedDateShow + "</p>";
            marker.bindPopup(popupContent);
        }
    }
}