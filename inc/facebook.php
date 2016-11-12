<?php
session_start();
// added in v4.0.0
require_once '../src/face/autoload.php';

//require_once './MetaSearch.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;

// start session
$FACE_APP_ID = "291386861194854";
$FACE_APP_TOKEN = "559b09bb8945413e6278123ef96f0384";
// init app with app id and secret
FacebookSession::setDefaultApplication($FACE_APP_ID, $FACE_APP_TOKEN);

// login helper with redirect_uri

$helper = new FacebookRedirectLoginHelper('http://citywatch.com.br/v1/inc/facebook.php');
$permissions = ['email', 'public_profile'];
try {
    $session = $helper->getSessionFromRedirect();
//var_dump($session);
} catch (FacebookRequestException $ex) {
    var_dump(ex);
// When Facebook returns an error
} catch (Exception $ex) {
    var_dump(ex);

// When validation fails or other local issues
}

// see if we have a session

if (isset($session)) {
    $request = new FacebookRequest($session, 'GET', '/me?fields=name,email,picture,hometown,locale,birthday');
    $response = $request->execute();
    $graphObject = $response->getGraphObject();

    $fbid = $graphObject->getProperty('id');              // To Get Facebook ID
    $fbuname = $graphObject->getProperty('username');  // To Get Facebook Username
    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
    $femail = $graphObject->getProperty('email');

    /* ---- Session Variables ----- */
    $_SESSION['FBID'] = $fbid;
    $_SESSION['USERNAME'] = $fbuname;
    $_SESSION['FULLNAME'] = $fbfullname;
    $_SESSION['EMAIL'] = $femail;
    $_SESSION['GRAPH'] = $graphObject;
    $_SESSION['BIRTH'] = $graphObject->getProperty('birthday');
    ?>
    <!doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>www.Citywatch.com.br</title>
            <link href="http://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
            <link rel="stylesheet" href="../assets/css/style.css">

            <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
            <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

        </head>
        <body>
            <div data-role="page" data-dialog="true">

                <div data-role="header" data-theme="b">
                    <h1>Obrigado!</h1>
                </div>
                <div role="main" >

                    <h2>
                        <?php
                        echo $_SESSION['FULLNAME'];
                        ?> agora você faz parte da nossa comunidade!<br>Nas próximas horas estaremos encaminhando um email para você!
                    </h2>
                    Lembre-se de assistir nosso videos, compartilhar com seus amigos e baixar o APP!
                    <div data-role="navbar">
                        <ul>
                            <li>
                                <a href="../">Voltar</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div data-role="footer">
                    <div align="center">
                        <a href="http://morettic.com.br" target="_blank">
                            <img src="http://morettic.com.br/wp2/wp-content/uploads/2014/10/morettic3.png" width="108" height="32" border="0">
                        </a> 
                    </div>
                </div>
                <!-- /footer -->
            </div>
        </body>
    </html>  
    <?

    require './Database.class.php';
    require '../src/ProfileManager.php';
    //require '../src/MetaSearch.php';

    ProfileManager::saveToList($femail); //Save to mail list

    $imagePk = ProfileManager::getImageTokenPkFacebook("https://graph.facebook.com/" . $_SESSION["FBID"] . "/picture", true);
    
    echo "TOKEN=>".$imagePk;

    $fbirthday = empty($graphObject->getProperty('birthday')) ? "dd/mm/yyyy" : $graphObject->getProperty('birthday');
    $jsonProfile = ProfileManager::saveUpdateProfile($femail, $imagePk, $fbfullname, "000.000.000-00", "00000000", "$femail", "n/a", "true", $fbirthday, -1);

    die();
    $_SESSION['profile'] = $jsonProfile;
//var_dump($_SESSION);
//
    //
    //Atualizado meu vai pra porra do sistema de busca
//echo "<a href='http://citywatch.com.br/smartapp/engine/search.php'>Continue</a><script>this.location.href='http://citywatch.com.br/smartapp/engine/search.php';</script>";
} else if (isset($_SESSION['FULLNAME'])) {
    ?>
    <!doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>www.Citywatch.com.br</title>
            <link href="http://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
            <link rel="stylesheet" href="../assets/css/style.css">

            <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
            <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

        </head>
        <body>
            <div data-role="page" data-dialog="true">

                <div data-role="header" data-theme="b">
                    <h1>Obrigado!</h1>
                </div>
                <div role="main" >

                    <h2>
                        <?php
                        echo $_SESSION['FULLNAME'];
                        ?>, você já está participando aguarde as novidades!
                    </h2>
                    Lembre-se de assistir os proximos videos e baixar o APP!

                </div>
                <div data-role="footer">
                    <div align="center">
                        <a href="http://morettic.com.br" target="_blank">
                            <img src="http://morettic.com.br/wp2/wp-content/uploads/2014/10/morettic3.png" width="108" height="32" border="0">
                        </a> 
                    </div>
                </div>
                <!-- /footer -->
            </div>
        </body>
    </html>  
    <?php
} else {
    $helper = new FacebookRedirectLoginHelper('http://citywatch.com.br/v1/inc/facebook.php');
    $permissions = ['email', 'public_profile', 'user_friends', 'user_hometown', 'user_birthday']; // optional
    ?>
    <!doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>www.Citywatch.com.br</title>
            <link href="http://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
            <link rel="stylesheet" href="../assets/css/style.css">

            <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
            <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

        </head>
        <body>
            <div data-role="page" data-dialog="true">

                <div data-role="header" data-theme="b">
                    <h1>Participar com o facebook</h1>
                </div>
                <div role="main" >
                    <p align="center"><h2>Falta apenas um passo para participar!</h2>Confirme seu acesso clicando no botão abaixo! </p>
                    <div data-role="navbar" class="whiteOne">
                        <ul>
                            <li>
                                <a href="<?php echo $helper->getLoginUrl($permissions); ?>">
                                    <img  src="../assets/images/f_facebook.png"/>
                                    <br>
                                    Facebook
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div data-role="footer">
                    <div align="center">
                        <a href="http://morettic.com.br" target="_blank">
                            <img src="http://morettic.com.br/wp2/wp-content/uploads/2014/10/morettic3.png" width="108" height="32" border="0">
                        </a> 
                    </div>
                </div>
                <!-- /footer -->
            </div>
        </body>
    </html>    
<?php } ?>
