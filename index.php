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
        <?php
        include_once './src/ProfileManager.php';

        $profile = new ProfileManager();
        ?>
    </head>
    <body>
        <div data-role="page">
            <?php $profile->showPanelOrNot(); ?>
            <div data-role="header" data-vertical-centred  data-theme="a">

                <?php $profile->btMenu(); ?>
                <div id="newsletterform">
                    <img src="assets/images/logo.png" height="65" class="ui-btn-icon-left"  align="left"/>
                    <a data-ajax="false" href="index.php#video" class="ui-btn ui-btn-inline ui-icon-video ui-btn-icon-top">Videos</a>
                    <a data-ajax="false" href="index.php#categoria" class="ui-btn ui-btn-inline ui-icon-check ui-btn-icon-top">Porque usar?</a>
                    <a data-ajax="false" href="index.php#participe" class="ui-btn ui-btn-inline ui-icon-check ui-btn-icon-top">Participe</a>
                </div>
            </div>

            <div role="main" class="ui-content noSpace" >
                <?php $profile->navigate($_GET['p']); ?>
            </div><!-- /content -->
            <div data-role="footer">
                <div id="newsletterform">
                    <center>Powered by:<br></center>
                        <a data-ajax="false" href="http://morettic.com.br" target="_blank" class="ui-btn-inline">
                            <img class="wrap" src="http://morettic.com.br/wp2/wp-content/uploads/2014/10/morettic3.png" width="108" height="32" border="0">
                        </a>
                        <a href="http://genimo.com.br" target="_blank" href="index.php#categoria" class="ui-btn-inline">GENIMO</a>
                </div>
            </div>
            <!-- /footer -->
        </div>
    </body>
</html>