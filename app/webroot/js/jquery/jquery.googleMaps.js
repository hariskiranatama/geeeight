/**
 * @author donny
 * required library:
 *    jQuery
 *    maps.google.com/maps/api/js
 */

//plugins
(function($){
  $.fn.googleMap = function(options) {
    var element = this;
    var defaults = {
      lat: -6.9208,
      lon: 107.6041,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: true,
      mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
      },
      scaleControl: true,
      navigationControl: true
    };
    options = $.extend(defaults, options || {});

    //put gmaps
    var center = new google.maps.LatLng(options.lat, options.lon);
    options.map = new google.maps.Map(element.get(0), $.extend(options, { center: center }));
    
    //center by address
    if (options.address != "") { //center map based on address
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({
        address: options.address
      }, function(results, status){
        if (status == google.maps.GeocoderStatus.OK && results.length) {
          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
            options.map.setCenter(results[0].geometry.location);
          }
        }
      });
    }

    //set data
    element.data('options', options);
    return this;
  };
})(jQuery);