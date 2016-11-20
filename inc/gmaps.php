<!-- <iframe src="https://citywatch.com.br/v1/inc/maps.php" allowfullscreen width="100%" height="600"></iframe> -->
<style>
    #map_canvas {
        margin: 0;
        padding: 0;
        height:72vh;
        width:100%
    }
</style>
<pre>
<?php var_dump($_SESSION); ?>
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
            zoom: 18,
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

<div id="map_canvas"></div>

