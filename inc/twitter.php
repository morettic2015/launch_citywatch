<?php
session_start();
//Include required lib from twitter
require "../autoload.php";

//Define apo
use Abraham\TwitterOAuth\TwitterOAuth;

//COnfig app Keys
include_once './Config.inc.php';
$userInfo = new stdClass();
//recover the parameter
$oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');
if (isset($_SESSION['profile'])) {
    $userInfo = $_SESSION['profile'];
} else {
    if (empty($oauth_verifier) ||
            empty($_SESSION['oauth_token']) ||
            empty($_SESSION['oauth_token_secret'])
    ) {

// create TwitterOAuth object
        $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

// request token of application
        $request_token = $twitteroauth->oauth(
                'oauth/request_token', [
            'oauth_callback' => 'http://citywatch.com.br/v1/inc/twitter.php'
                ]
        );

// throw exception if something gone wrong
        if ($twitteroauth->getLastHttpCode() != 200) {
            throw new \Exception('There was a problem performing this request');
        }

// save token of application to session
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

// generate the URL to make request to authorize our application
        $url = $twitteroauth->url(
                'oauth/authorize', [
            'oauth_token' => $request_token['oauth_token']
                ]
        );

// and redirect
        header('Location: ' . $url);
    } else {
        //echo "<pre>";
        //var_dump($_SESSION);
        // connect with application token
        $connection = new TwitterOAuth(
                CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']
        );

// request user token
        $token = $connection->oauth(
                'oauth/access_token', [
            'oauth_verifier' => $oauth_verifier
                ]
        );

        $connection = new TwitterOAuth(
                CONSUMER_KEY, CONSUMER_SECRET, $token['oauth_token'], $token['oauth_token_secret']
        );
        $userInfo = $connection->get('account/verify_credentials', ['include_email' => 'true']);

        ProfileManager::setProfileSession($userInfo,"TWITTER");
        $_SESSION['profile'] = $userInfo;

        /* echo $userInfo->email;
          echo $userInfo->profile_image_url; */

        require './Database.class.php';
        require '../src/ProfileManager.php';
        //require '../src/MetaSearch.php';

        $femail = $userInfo->email;
        $fbfullname = $userInfo->name;
        $avatar = $userInfo->profile_image_url;
        //$femail=$userInfo->name;


        ProfileManager::saveToList($femail); //Save to mail list
        $imagePk = ProfileManager::getImageTokenPkFacebook($avatar, false);
        //$fbirthday = empty($graphObject->getProperty('birthday')) ? "dd/mm/yyyy" : $graphObject->getProperty('birthday');
        $jsonProfile = ProfileManager::saveUpdateProfile($femail, $imagePk, $fbfullname, "000.000.000-00", "00000000", "$femail", "n/a", "true", "dd/mm/yyyy", -1);
        //header('Location: ./twitter.php');
    }
}
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
<?php echo $userInfo->name; ?> agora você faz parte da nossa comunidade!<br>Nas próximas horas estaremos encaminhando um email para você!
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