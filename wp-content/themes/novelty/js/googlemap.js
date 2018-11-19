
/* GOOGLE MAP
============================================================*/
(function($) {
    "use strict";
 
    $(function() {
     
        $('.flexible-map').each( function() {
            
            var $map_id = $(this).attr('id'),
            $title = $(this).find('.title').val(),
            $location = $(this).find('.location').val(),
            $coordinates = $(this).find('.coordinates').val(),
            $zoom = parseInt( $(this).find('.zoom').val() ),
            map;
            
            //break down $coordinates and rebuild into correct format
            $coordinates = $coordinates.split(',');
            
            var location = new google.maps.LatLng($coordinates[0],$coordinates[1]);
            
            var mapOptions = {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: location,
                zoom: $zoom
            };
            
            map = new google.maps.Map($('#'+ $map_id + ' .map_canvas')[0], mapOptions);
            
            var marker = new google.maps.Marker({
              map: map,
              position: location,
              title : $location
            });
            
            var contentString = '<div class="map-infowindow">'+
                ( ($title) ? '<h3>' + $title + '</h3>' : '' ) + 
                $location + '<br/>' +
                '<a href="https://maps.google.com/?q='+ $coordinates +'" target="_blank">View on Google Map</a>' +
                '</div>';
            
            var infowindow = new google.maps.InfoWindow({
              content: contentString
            });
            
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });
            
        }); 

    });
 
}(jQuery));