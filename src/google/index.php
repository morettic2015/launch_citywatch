<?php
include_once("config.php");
include_once("includes/functions.php");

//print_r($_GET);die;
if(isset($_SESSION['profile'])){
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
                        echo $_SESSION['google_data']['name'];
                        ?> agora você faz parte da nossa comunidade!<br>Nas próximas horas estaremos encaminhando um email para você!
                    </h2>
                    Lembre-se de assistir nosso videos, compartilhar com seus amigos e baixar o APP!
                    <div data-role="navbar">
                        <ul>
                            <li>
                                <a href="../../">Voltar</a>
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
<?php 
}else{
if (isset($_REQUEST['code'])) {
    $gClient->authenticate();
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectUrl, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
    $userProfile = $google_oauthV2->userinfo->get();
    //DB Insert
    $gUser = new Users();
    $gUser->checkUser('google', $userProfile['id'], $userProfile['given_name'], $userProfile['family_name'], $userProfile['email'], $userProfile['gender'], $userProfile['locale'], $userProfile['link'], $userProfile['picture']);
    $_SESSION['google_data'] = $userProfile; // Storing Google User Data in Session
  
    //var_dump($_SESSION);die();
    
    require '../../inc/Database.class.php';
    require '../../src/ProfileManager.php';
  
    ProfileManager::saveToList($_SESSION['google_data']['email']); //Save to mail list
    $imagePk = ProfileManager::getImageTokenPkGoogle($_SESSION['google_data']['picture'], false);
    $complemento = $_SESSION['google_data']['name'] . " / " . $_SESSION['google_data']['gender'];

    $jsonProfile = ProfileManager::saveUpdateProfile(   $_SESSION['google_data']['email'], 
                                                        $imagePk, 
                                                        $_SESSION['google_data']['given_name'], 
                                                        "000.000.000-00", 
                                                        "00000000", 
                                                        $_SESSION['google_data']['email'], 
                                                        $complemento, 
                                                        "true", 
                                                        "dd/mm/yyyy", 
                                                        -1);
    
    ProfileManager::setProfileSession($jsonProfile, "GOOGLE");
    //die();
    $_SESSION['profile'] = $jsonProfile;
    /**
      echo '<div class="welcome_txt">Welcome <b>'.$_SESSION['google_data']['given_name'].'</b></div>';
      echo '<div class="google_box">';
      echo '<p class="image"><img src="'.$_SESSION['google_data']['picture'].'" alt="" width="300" height="220"/></p>';
      echo '<p><b>Google ID : </b>' . $_SESSION['google_data']['id'].'</p>';
      echo '<p><b>Name : </b>' . $_SESSION['google_data']['name'].'</p>';
      echo '<p><b>Email : </b>' . $_SESSION['google_data']['email'].'</p>';
      echo '<p><b>Gender : </b>' . $_SESSION['google_data']['gender'].'</p>';
      echo '<p><b>Locale : </b>' . $_SESSION['google_data']['locale'].'</p>';
      echo '<p><b>Google+ Link : </b>' . $_SESSION['google_data']['link'].'</p>';
      echo '<p><b>You are login with : </b>Google</p>';
      echo '<p><b>Logout from <a href="logout.php?logout">Google</a></b></p>';
     *      */
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
                        echo $_SESSION['google_data']['name'];
                        ?> agora você faz parte da nossa comunidade!<br>Nas próximas horas estaremos encaminhando um email para você!
                    </h2>
                    Lembre-se de assistir nosso videos, compartilhar com seus amigos e baixar o APP!
                    <div data-role="navbar">
                        <ul>
                            <li>
                                <a href="../../">Voltar</a>
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
    <?php
    $_SESSION['token'] = $gClient->getAccessToken();
} else {
    $authUrl = $gClient->createAuthUrl();
}

if (isset($authUrl)) {
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
                    <h1>Participar com o google</h1>
                </div>
                <div role="main" >
                    <p align="center"><h2>Falta apenas um passo para participar!</h2>Confirme seu acesso clicando no botão abaixo! </p>
                    <div data-role="navbar" class="whiteOne">
                        <ul>
                            <li>
                                <?php
                                echo '<a href="' . $authUrl . '"><img src="images/glogin.png" alt=""/></a>';
                                ?> 
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
<? } }?>