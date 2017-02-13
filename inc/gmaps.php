<style>
    #map_canvas {
        margin: 0;
        padding: 0;
        height:100vh;
        width:100%
    }
</style>

<?php
//include '../src/ProfileManager.php';
//($city, $type, $distance, $lat, $lon, $id)
//var_dump($_POST);die();
/* @var $_POST type */

$city = $_POST['city'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];
$kw = $_POST['keywords'];
$canais = $_POST['canais'];
$range = $_POST['range'];
$id = $_POST['idProfile'];
$selecao = "";
$range*=20;
//echo $range;
//var_dump($_POST);

$tpList = ProfileManager::typeList();
$vet = $tpList->types;
//var_dump($vet);
foreach ($vet as $objeto) {
    if (!empty($_POST[$objeto])) {
        $selecao.= $objeto . ',';
    }
}
//echo "aaaaaaa";
//echo $selecao;
//die();

$jsonRet = ProfileManager::getGeoLocationsFromProfile($city, $selecao, $range, $lat, $lon, $id);
//echo "<pre>";
//var_dump($jsonRet);
//var_dump($_POST);
?>
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
                    zoom: 14,
                            center: new google.maps.LatLng(crd.latitude, crd.longitude),
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            styles:[{"featureType":"administrative", "elementType":"labels.text.fill", "stylers":[{"color":"#6195a0"}]}, {"featureType":"landscape", "elementType":"all", "stylers":[{"color":"#f2f2f2"}]}, {"featureType":"landscape", "elementType":"geometry.fill", "stylers":[{"color":"#ffffff"}]}, {"featureType":"poi", "elementType":"all", "stylers":[{"visibility":"off"}]}, {"featureType":"poi.park", "elementType":"geometry.fill", "stylers":[{"color":"#e6f3d6"}, {"visibility":"on"}]}, {"featureType":"road", "elementType":"all", "stylers":[{"saturation": - 100}, {"lightness":45}, {"visibility":"simplified"}]}, {"featureType":"road.highway", "elementType":"all", "stylers":[{"visibility":"simplified"}]}, {"featureType":"road.highway", "elementType":"geometry.fill", "stylers":[{"color":"#f4d2c5"}, {"visibility":"simplified"}]}, {"featureType":"road.highway", "elementType":"labels.text", "stylers":[{"color":"#4e4e4e"}]}, {"featureType":"road.arterial", "elementType":"geometry.fill", "stylers":[{"color":"#f4f4f4"}]}, {"featureType":"road.arterial", "elementType":"labels.text.fill", "stylers":[{"color":"#787878"}]}, {"featureType":"road.arterial", "elementType":"labels.icon", "stylers":[{"visibility":"off"}]}, {"featureType":"transit", "elementType":"all", "stylers":[{"visibility":"off"}]}, {"featureType":"water", "elementType":"all", "stylers":[{"color":"#eaf6f8"}, {"visibility":"on"}]}, {"featureType":"water", "elementType":"geometry.fill", "stylers":[{"color":"#eaf6f8"}]}]
                    };
                    map = new google.maps.Map(document.getElementById('map_canvas'),
                            mapOptions);
<?php
if (!empty($jsonRet->openStreet)) {
    $vetOpenStreet = $jsonRet->openStreet;
//print_r($vetOpenStreet);die();
    $profile = $jsonRet->profiles;
    $dataStore = $jsonRet->rList;
    $i = 0;
    foreach ($vetOpenStreet as $objeto) {
        $indice = rand(0, 4);
        $img = ($objeto->token == "default") ? "https://www.citywatch.com.br/v1/assets/images/Openstreet-01.png" : $objeto->token;
        ?>

                    var marker<?php echo $i; ?> = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $objeto->lat; ?>, <?php echo $objeto->lon; ?>),
                            map: map,
                            icon: '<?php echo ProfileManager::getImagePathFromToken($objeto->tipo); ?>',
                            title: '<?php str_replace("'", "´", $objeto->tit); ?>'
                    });
                            try {
                            var contentString<?php echo $i; ?> = '<div id="content"><h1><?php echo str_replace("'", "´", $objeto->tit); ?></h1><img style="border-radius: 50%;max-width:96px" src="<?php echo $img; ?>"/><?php echo str_replace("'", "´", $objeto->desc); ?><br><?php echo str_replace("'", "´", $objeto->address); ?><br><?php echo $objeto->date; ?><br>Author:<?php echo $profile[$indice]->email; ?><br><img src="<?php
        echo $profile[$indice]->avatar;
        ;
        ?>"/></div>';
                                    var infowindow<?php echo $i; ?> = new google.maps.InfoWindow({
                                    content: contentString<?php echo $i; ?>
                                    });
                                    google.maps.event.addListener(marker<?php echo $i; ?>, 'click', function () {
                                    infowindow<?php echo $i; ?>.open(map, marker<?php echo $i; ?>);
                                    });
                            } catch (e) {
                    alert(e);
                    }
        <?php
        $i++;
    }
}
if (!empty($jsonRet->iList)) {
    $vetOpenStreet = $jsonRet->iList;
    //var_dump($vetOpenStreet);
    //die();
    foreach ($vetOpenStreet as $objeto) {
        $pic = str_replace("HTTP://www.genimo.com.br", "https://genimo.com.br", $objeto->nmPicture);
        $logo = str_replace("HTTP://www.genimo.com.br", "https://genimo.com.br", $objeto->dsCompanyLogo);
        ?> try {
                    var marker<?php echo $i; ?> = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $objeto->vlLatitude; ?>, <?php echo $objeto->vlLongitude; ?>),
                            map: map,
                            icon: './assets/images/imoveis.png',
                            title: '<?php echo str_replace("'", "´", $objeto->nmCategory); ?>'
                    });
                            var contentString<?php echo $i; ?> = '<div id="content" align="center"><img src="<?php echo $pic; ?>" style="border-radius: 50%;;max-width:120px" /><h1><?php echo $objeto->nmCategory; ?></h1><?php echo $objeto->nmProperty; ?><br><?php echo str_replace("'", "´", $objeto->dsAddress); ?><br><?php echo $objeto->date; ?><br>Corretora:<?php echo $objeto->nmCompany; ?><br><img src="<?php
        echo $logo;
        ?>"/><a class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-star ui-btn-c">Favoritos</a></div>';
                            var infowindow<?php echo $i; ?> = new google.maps.InfoWindow({
                            content: contentString<?php echo $i; ?>
                            });
                            google.maps.event.addListener(marker<?php echo $i; ?>, 'click', function () {
                            infowindow<?php echo $i; ?>.open(map, marker<?php echo $i; ?>);
                            });
                    } catch (e) {
                    alert(e);
                    }
        <?php
        $i++;
    }
}
if (!empty($jsonRet->rList)) {
    $vetOpenStreet = $jsonRet->rList;
    foreach ($vetOpenStreet as $objeto) {
        ?> try {
                    var marker<?php echo $i; ?> = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $objeto->lat; ?>, <?php echo $objeto->lon; ?>),
                            map: map,
                            icon: '<?php echo ProfileManager::getImagePathFromToken($objeto->tipo); ?>',
                            title: '<?php echo str_replace("'", "´", $objeto->tit); ?>'
                    });
                            var contentString<?php echo $i; ?> = '<div id="content" align="center"><img src="<?php echo ProfileManager::getImagePathFromId($objeto->token); ?>" style="border-radius: 50%;;max-width:96px" /><h1><?php echo str_replace("'", "´", $objeto->tit); ?></h1><?php echo str_replace("'", "´", $objeto->desc); ?><br><?php echo $objeto->tipo; ?><br><?php echo $objeto->date; ?><br>Author:<?php echo $objeto->email; ?><br><img src="<?php
        echo ProfileManager::getImagePathFromId($objeto->avatar);
        ?>" width="90" height="90"/><a class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-star ui-btn-c">Favoritos</a></div>';
                            var infowindow<?php echo $i; ?> = new google.maps.InfoWindow({
                            content: contentString<?php echo $i; ?>
                            });
                            google.maps.event.addListener(marker<?php echo $i; ?>, 'click', function () {
                            infowindow<?php echo $i; ?>.open(map, marker<?php echo $i; ?>);
                            });
                    } catch (e) {
                    alert(e);
                    }
        <?php
        $i++;
    }
}
?>
            }
    ;
            function error(err) {
            console.warn('ERROR(' + err.code + '): ' + err.message);
            }
    ;
            navigator.geolocation.getCurrentPosition(success, error, options);
</script>
<div id="map_canvas"></div>

