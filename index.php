<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>www.Citywatch.com.br</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.2/jquery.mobile.icons-1.4.2.css" />
        <link rel="stylesheet" href="https://andymatthews.net/code/jquery-mobile-icon-pack/dist/jqm-icon-pack-fa.css"/>
        <link rel="stylesheet" href="./assets/css/style.css">
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCkJEjT73RmsOw1Ldy3S9RbWg_-PDRh8zE"></script>
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
            <div data-role="header" data-vertical-centred  data-theme="a"  data-position="fixed" data-fullscreen="true"  data-theme="d">
                <?php $profile->btMenu(); ?>
                <center>
                    <img src="assets/images/logo.png" height="65"/>
                </center>
            </div>

            <div role="main" class="ui-content noSpace"  data-theme="c" >
                <?php $profile->navigate($_GET['p']); ?>
            </div><!-- /content -->
            <div data-role="footer"  data-position="fixed" data-fullscreen="true"  data-theme="b" align="right">
                Powered by:
                <a href="http://genimo.com.br" target="_blank" class="ui-btn-r">GENIMO</a>
                <a data-ajax="false" href="http://morettic.com.br" target="_blank" class="ui-btn-inline">
                    <img class="wrap" src="http://morettic.com.br/wp2/wp-content/uploads/2014/10/morettic3.png" width="50" border="0">
                </a>
            </div>
            <!-- /footer -->
        </div>
    </body>
</html>