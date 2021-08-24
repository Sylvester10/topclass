//Google map for school location 
var lat = 4.971951; 
var lng = 8.354686;

// When the window has finished loading create our google map below
google.maps.event.addDomListener(window, 'load', initialize_map);
var myCenter = new google.maps.LatLng(lat, lng);

function initialize_map() {
    var mapOptions = {
        zoom: 15,
        scrollwheel: false,
        center: myCenter,
    };

    var mapElement = document.getElementById('googleMap');
    // Create the Google Map using our element and options defined above
    var map = new google.maps.Map(mapElement, mapOptions);
    //add a marker
    var marker = new google.maps.Marker({
        position: myCenter,
    });
    marker.setMap(map);
}