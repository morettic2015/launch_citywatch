<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Citywatch - Compartilhe suas experiências pelas cidades!</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.2/jquery.mobile.icons-1.4.2.css" />
        <link rel="stylesheet" href="./assets/css/style.css">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkJEjT73RmsOw1Ldy3S9RbWg_-PDRh8zE&libraries=places" async defer></script>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script src="https://www.gstatic.com/firebasejs/3.6.1/firebase.js"></script>
        <script>
            // Initialize Firebase
            var config = {
                apiKey: "AIzaSyCiWk8UluHYqp328Js3jHD3Vz9fKNsyx90",
                authDomain: "gaeloginendpoint.firebaseapp.com",
                databaseURL: "https://gaeloginendpoint.firebaseio.com",
                storageBucket: "gaeloginendpoint.appspot.com",
                messagingSenderId: "811880962924"
            };
            firebase.initializeApp(config);
        </script>
        <?php
        include_once './src/ProfileManager.php';

        $profile = new ProfileManager();
        ?>
    </head>
    <body>
        <div data-role="page">
            <?php $profile->showPanelOrNot(); ?>
            <div data-role="header" data-vertical-centred  data-theme="a"  data-position="fixed" data-fullscreen="true">
                <?php $profile->btMenu(); ?>
                <?php if(!$profile->looged()){ ?>
                <a href="#popupMenu" data-rel="popup" data-transition="slideup" class="ui-btn ui-corner-all ui-shadow ui-btn-right ui-icon-lock ui-btn-icon-right">Minha conta</a>
                <div data-role="popup" id="popupMenu" data-theme="g">
                    <ul data-role="listview" data-inset="true">
                        <li data-role="list-divider">Selecione sua Rede social</li>
                        <li><a href="#./inc/facebook.php" data-transition="pop">Facebook</a></li>
                        <li><a href="./inc/twitter.php" data-ajax="false" >Twitter</a></li>
                        <li><a href="#./src/google/" data-transition="pop">Google+</a></li>
                    </ul>
                </div>
                <? } ?>

                <img src="assets/images/logo.png" height="65" class="ui-btn-icon-left" />
            </div>

            <div role="main" class="ui-content noSpace">
                <?php $profile->navigate($_GET['p']); ?>
            </div><!-- /content -->
            <div data-role="footer"   data-position="fixed" data-fullscreen="true" align="right">
                <a href="#myPanel" data-role="button" class="ui-btn-left" > 
                    <img class="wrap" src="assets/images/download.png" height="30" border="0">
                </a>
                Powered by:
                <!--  <a href="http://genimo.com.br" target="_blank"  data-theme="b" >GENIMO</a> -->
                <a data-ajax="false" href="http://morettic.com.br" target="_blank">
                    <img class="wrap" src="http://morettic.com.br/wp2/wp-content/uploads/2014/10/morettic3.png" height="30" border="0">
                </a>

            </div>
            <!-- /footer -->
        </div>
    </body>
</html>