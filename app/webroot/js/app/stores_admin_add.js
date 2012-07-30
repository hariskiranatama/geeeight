/* 
 * Display google maps and marker to set stores location easily
 */

//variable declaration
var marker = false;
var markerOptions = false;

var handle_marker_drag = function($, marker) {
    //handle marker dragend
    google.maps.event.addListener(marker, 'drag', function(event){
        var coord = event.latLng;
        $('#StoreLatitude').val(coord.lat());
        $('#StoreLongitude').val(coord.lng());
    });
};

//Execute code after DOM loaded
jQuery(function($){
    //draw google maps
    var options;
    if ($('#StoreLatitude').val() != "" && $('#StoreLongitude').val() != ""){
        options = {
            lat: parseFloat($('#StoreLatitude').val()),
            lon: parseFloat($('#StoreLongitude').val())
        };
        markerOptions = {
            position: new google.maps.LatLng(options.lat, options.lon),
            draggable: true,
            icon: marker_icon
        };
    }
    else {
        options = {
            zoom: 13
        };
    }
    $("#map_canvas").googleMap(options);
    var map_canvas = $("#map_canvas").data('options').map;
    if ( markerOptions ){
        markerOptions.map = map_canvas;
        marker = new google.maps.Marker(markerOptions);
        //handle marker dragend
        handle_marker_drag($, marker);
    }
    //handle click event
    google.maps.event.addListener(map_canvas, 'click', function(event){
        if ( ! marker ) {
            var coord = event.latLng;
            marker = new google.maps.Marker({
                position: coord,
                map: map_canvas,
                draggable: true,
                icon: marker_icon
            });
            $('#StoreLatitude').val(coord.lat());
            $('#StoreLongitude').val(coord.lng());
            //handle marker dragend
            handle_marker_drag($, marker);
        }
    });

    //handle removeMap
    $("#removeMap").live('click', function(e){
        e.preventDefault();
        if ( marker ) {
            if ( confirm('Are you sure to remove the map marker for this store?') ) {
                marker.setMap(null);
                marker = false;
                $('#StoreLatitude').val("");
                $('#StoreLongitude').val("");
            }
        }
    });

});
