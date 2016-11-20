
<!DOCTYPE html>
<html>
    <head>
        <title>Google Maps JavaScript API v3 Example: Map Simple</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
        <meta charset="utf-8"/>
        <style>
            html, body, #map_canvas {
                margin: 0;
                padding: 0;
                height: 100%;
            }
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCkJEjT73RmsOw1Ldy3S9RbWg_-PDRh8zE"></script>
        <script>
            var map;




            var options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };

            function success(pos) {
                var crd = pos.coords;

                console.log('Your current position is:');
                console.log('Latitude : ' + crd.latitude);
                console.log('Longitude: ' + crd.longitude);
                console.log('More or less ' + crd.accuracy + ' meters.');
                var mapOptions = {
                    zoom: 8,
                    center: new google.maps.LatLng(crd.latitude, crd.longitude),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById('map_canvas'),
                        mapOptions);
            }
            ;

            function error(err) {
                console.warn('ERROR(' + err.code + '): ' + err.message);
            }
            ;

            navigator.geolocation.getCurrentPosition(success, error, options);
        </script>
    </head>
    <body>
        <div id="map_canvas"></div>
    </body>
</html>
