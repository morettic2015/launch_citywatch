<?php
include_once './engine/header_lib.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>City Watch - Smartcities APP</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="js/css/lib/control/iconselect.css" >
        <script type="text/javascript" src="js/lib/control/iconselect.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkJEjT73RmsOw1Ldy3S9RbWg_-PDRh8zE&signed_in=false&callback=initMap" async defer />
        <script type = "text/javascript" src = "js/lib/iscroll.js" ></script>  
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="js/engine.js"></script>
    </head>
    <body>
        <!-- HEADER -->
        <?php include_once './engine/h_layout.php'; ?>
        <div id="logo-container" >
            <img id="logo-image" src="http://smartapp.morettic.com.br/resources/city_watch_play.png">
        </div>
        <form action="/engine/" method="POST">
            <input type="text" name="q">
            <input type="hidden" name="id" value="<?php echo $jsonObjet->key; ?>">
            <input type="hidden" id="tipo" name="tipo">
            <div>
                <input type="submit" class="ui-button" style="width: 30%" name="google-search" value="Buscar ocorrências">
            </div>
        </form>
        <!-- Footer -->
        <?php include './engine/f_layout.php'; ?>
    </body>
</html>