/* 
 * Display google maps and marker to set stores location easily
 */

//variable declaration
var marker = [];
var markerOptions = [];

//Execute code after DOM loaded
jQuery(function($){
    //draw google maps
    var options;
    if ( $(".map_canvas").length > 0 ){
        for (var i = 0; i < $(".map_canvas").length; i++) {
            var map = $(".map_canvas").eq(i);
            var parent_div = map.parent();
            options = {
                lat: parseFloat($('input[name="latitude"]', parent_div).val()),
                lon: parseFloat($('input[name="longitude"]', parent_div).val()),
                navigationControl: true,
                mapTypeControl: false,
                scaleControl: false
            };
            markerOptions[i] = {
                position: new google.maps.LatLng(options.lat, options.lon),
                draggable: false,
                icon: marker_icon
            };
            map.googleMap(options);
            var map_canvas = map.data('options').map;
            if ( markerOptions[i] ){
                markerOptions[i].map = map_canvas;
                marker[i] = new google.maps.Marker(markerOptions[i]);
            }
        }
    }

});
