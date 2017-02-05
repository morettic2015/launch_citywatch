<?php
session_start();
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
include '../../inc/Config.inc.php';

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Citywatch.com.br');
$gClient->setClientId(clientId);
$gClient->setClientSecret(clientSecret);
$gClient->setRedirectUri("https://www.citywatch.com.br/v1/src/google/index.php");

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>