<?php
session_start();
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
include '../../inc/Config.inc.php';

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Login to codexworld.com');
$gClient->setClientId(clientId);
$gClient->setClientSecret(clientSecret);
$gClient->setRedirectUri(redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>