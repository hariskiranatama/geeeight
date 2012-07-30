/* 
 * Display google maps and marker to set stores location easily
 */

//variable declaration
var marker = false;
var markerOptions = false;

//Execute code after DOM loaded
jQuery(function($){
    //draw google maps
    var options;
    if ( $("#map_canvas").length > 0 &&
         $('#StoreLatitude').val() != "" &&
         $('#StoreLongitude').val() != "" ){
        options = {
            lat: parseFloat($('#StoreLatitude').val()),
            lon: parseFloat($('#StoreLongitude').val())
        };
        markerOptions = {
            position: new google.maps.LatLng(options.lat, options.lon),
            draggable: false,
            icon: marker_icon
        };
        $("#map_canvas").googleMap(options);
        var map_canvas = $("#map_canvas").data('options').map;
        if ( markerOptions ){
            markerOptions.map = map_canvas;
            marker = new google.maps.Marker(markerOptions);
        }
    }

});
