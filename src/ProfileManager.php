<?php

@session_start();

/**

 * Profile manager
 * @Connect to the webservice from gae to create ACC
 * 
 *  */
        const local_directory = '../dir/';

class ProfileManager {

    var $tipoProfile = array("GOOGLE", "TWITTER", "FACEBOOK");
    var $mProfileSource = null;

    public static final function getImagePathFromId($id) {
        return "http://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=8&id=" . $id;
    }

    public static final function getGeoLocationsFromProfile($city, $type, $distance, $lat, $lon, $id) {
        $url = "http://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=6&id=$id&lat=$lat&lon=$lon&d=$distance&type=$type&myCity=" . ProfileManager::stripAcentos($city);
        $jsonRet = file_get_contents($url);
        //echo $url;die();
        //var_dump($jsonRet);
        return json_decode($jsonRet);
    }

    public static final function stripAcentos($r) {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $r);
    }

    public static final function getJsonFromLatLon() {


        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        $ipaddress;


        $url = "http://ip-api.com/json/$ipaddress";
        $jsonRet = file_get_contents($url);
        $jsonObjet = json_decode($jsonRet);



        return $jsonObjet;
    }

    public static final function getEmail() {
        //echo "<pre>";
        //var_dump($_SESSION);
        //echo $_SESSION['source'];
        if ($_SESSION['source'] == "GOOGLE") {
            echo $_SESSION['google_data']['email'];
        } else if (isset($_SESSION['EMAIL'])) {
            echo $_SESSION['EMAIL'];
        } else {
            echo $_SESSION['profile_twitter']->email;
        }
    }

    public static final function getName() {
        //echo $_SESSION['source'];
        if ($_SESSION['source'] == "GOOGLE") {
            echo $_SESSION['google_data']['name'];
        } else if (isset($_SESSION['EMAIL'])) {
            echo $_SESSION['FULLNAME'];
        } else {
            echo $_SESSION['profile_twitter']->name;
        }
    }

    public static final function loadPromotions($myId) {
        $url = 'http://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=25';
        if (!empty($myId)) {
            $url.="&idProfile=" . $myId;
        }

        $jsonRet = file_get_contents($url);
        $jsonObjet = json_decode($jsonRet);



        return $jsonObjet;
    }

    public static final function loadFavorite($myId) {
        $url = 'http://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=27&id='.$myId;
        $jsonRet = file_get_contents($url);
        $jsonObjet = json_decode($jsonRet);
        return $jsonObjet;
    }

    public static final function getAvatar() {
        //echo $_SESSION['source'];
        if ($_SESSION['source'] == "GOOGLE") {
            echo $_SESSION['google_data']['picture'];
        } else if (isset($_SESSION['EMAIL'])) {
            echo "https://graph.facebook.com/" . $_SESSION["FBID"] . "/picture";
        } else {
            echo $_SESSION['profile_twitter']->profile_image_url;
        }
    }

    public static final function navigate($url) {
        $pg = empty($url) ? "main" : $url;
        include_once './inc/' . $pg . ".php";
    }

    public static final function btMenu() {
        if (isset($_SESSION['profile'])) {
            echo '<a href="#myPanel" data-role="button" data-icon="bars" class="ui-btn-left" data-iconpos="notext" data-inline="true"></a>';
           // echo '<a href="#myPanel" data-role="button" class="ui-btn-left"  data-icon="bars">Menu</a>';
        }
    }

    public static final function setProfileSession($sess, $source) {
        $_SESSION['profile'] = $sess;
        $_SESSION['source'] = $source;
    }

    public static final function showPanelOrNot() {
        if (isset($_SESSION['profile'])) {
            include 'panel.php';
        }
    }

    public static function saveToList($femail) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $existingSignup = $pdo->prepare("SELECT COUNT(*) FROM signups WHERE signup_email_address='$femail'");
        $existingSignup->execute();
        $data_exists = ($existingSignup->fetchColumn() > 0) ? true : false;

        if (!$data_exists) {
            $sql = "INSERT INTO signups (signup_email_address, signup_date) VALUES (:email, now())";
            $q = $pdo->prepare($sql);

            $q->execute(
                    array(':email' => $femail));

            if ($q) {
                $status = "success";
                $message = "SUCESSO! MUITO OBRIGADO!";
            } else {
                $status = "error";
                $message = "Um erro ocorreu. Tente outra vez.";
            }
        } else {
            $status = "error";
            $message = "Email existente....";
        }

        $data = array(
            'status' => $status,
            'message' => $message
        );
        //var_dump($data);

        Database::disconnect();
        return json_encode($data);
    }

    function initialize() {

        if (isset($_SESSION['FULLNAME'])) {
            $this->mProfileSource = $this->tipoProfile[2];
        }
    }

    function getUrlPath($titulo, $lat, $lon, $description, $imageKey, $tipo, $address, $profileId) {
        return $url = "https://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=1&" .
                "titulo=" . urlencode($titulo) .
                "&lat=$lat" .
                "&lon=$lon" .
                "&desc=" . urlencode($description) .
                "&idPic=$imageKey" .
                "&tipo=$tipo" .
                "&address=" . urlencode($address) .
                "&idProfile=$profileId";
    }

    function getimg($url) {
        $headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
        $headers[] = 'Connection: Keep-Alive';
        $headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
        $user_agent = 'php';
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($process, CURLOPT_HEADER, 0);
        curl_setopt($process, CURLOPT_USERAGENT, $useragent);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        $return = curl_exec($process);

        //var_dump($return);

        curl_close($process);
        return $return;
    }

    /**
      @Perfil existe na base de dados;
     *      */
    public static function existProfile($email) {
        $url = "http://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=11&email=" . $email;
        $jsonRet = file_get_contents($url);

        // var_dump($jsonRet);
        $tot = json_decode($jsonRet);

        return $tot->total == "1" ? true : false;
    }

    public static function saveUpdateProfile($email, $avatar, $nome, $cpfCnpj, $cep, $passwd, $complemento, $pjf, $nasc, $id) {

        $url = "https://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=3&" .
                "email=" . $email .
                "&avatar=" . $avatar .
                "&nome=" . urlencode($nome) .
                "&cpfCnpj=" . urlencode($cpfCnpj) .
                "&cep=" . urlencode($cep) .
                "&passwd=" . $passwd .
                "&complemento=" . urlencode($complemento) .
                "&pjf=" . $pjf .
                "&nasc=" . urlencode($nasc) .
                "&id=" . $id;

        //echo "<pre>";
        // echo $url;

        $jsonRet = file_get_contents($url);

        // var_dump($jsonRet);
        return json_decode($jsonRet);
    }

    public static final function retCURL(&$postfields, $url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_USERAGENT, "Citywatch.com.br[phpUpload]");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        return $ch;
    }

    /**
      Obrigado!
      Angelo Miguel Arcanjo agora você faz parte da nossa comunidade!
      Nas próximas horas estaremos encaminhando um email para você!

      Lembre-se de assistir nosso videos, compartilhar com seus amigos e baixar o APP!
      Voltar

      array(2) { ["status"]=> string(5) "error" ["message"]=> string(19) "Email existente...." } Copied Profile Picturestring(272) "{"uploadPath":"http://gaeloginendpoint.appspot.com/_ah/upload/AMmfu6bXvTzu5V9qfVOmgEzL0LEywWFGchFlf1pbdD8jWDPI343s0l2X_312K9hI0dY_KsxIG0le7Md-uFy8dbqb9FLsSsKZ-rpLLYYxsVs6ocp0QAvuWFeMmWx2X_csLTj9N5qkrVLhm3Mif9_bqqn9FsTVR0vo2g/ALBNUaYAAAAAWCZbRr5vd44_xUTqYqdU9r5z0NcSsrAM/"}"
      Warning: fopen(../dir/avatar.jpg): failed to open stream: No such file or directory in /home/citywatch/www/v1/src/ProfileManager.php on line 136
      http://gaeloginendpoint.appspot.com/_ah/upload/AMmfu6bXvTzu5V9qfVOmgEzL0LEywWFGchFlf1pbdD8jWDPI343s0l2X_312K9hI0dY_KsxIG0le7Md-uFy8dbqb9FLsSsKZ-rpLLYYxsVs6ocp0QAvuWFeMmWx2X_csLTj9N5qkrVLhm3Mif9_bqqn9FsTVR0vo2g/ALBNUaYAAAAAWCZbRr5vd44_xUTqYqdU9r5z0NcSsrAM/IMAGE PK__==5133583953952768
     * 
     *  */
    public static final function loadImageKey($imagePath, $redirec = false) {
        $upload = "http://gaeloginendpoint.appspot.com/upload.exec";
        $jsonRet = file_get_contents($upload);
        $jsonObjet = json_decode($jsonRet);
        //var_dump($jsonRet);
        $handle = fopen(local_directory . "avatar.jpg", "r");
        $url = "$jsonObjet->uploadPath";

        $post_array = array(
            "myFile" => curl_file_create(local_directory . "avatar.jpg", 'image/jpeg', 'avatar.jpg'),
            "upload" => "avatar.jpg"
        );
        $ch = ProfileManager::retCURL($post_array, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
        $response = curl_exec($ch);
        //echo $response."=>RESPONSE";

        return ProfileManager::saveImageBigData($response, $url);
    }

    public static final function saveImageBigData($response, $url) {
        $url = "https://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=2&iName=airport.jpg&iToken=$response";
        $jsonRet = file_get_contents($url);
        $jsonObjet = json_decode($jsonRet);
        return $jsonObjet->key;
    }

    public static final function getImageFromToken($token) {
        $path = "";
        if ($token == "SEGURANCA") {
            $path = "assets/images/seguranca.png";
        } else if ($token == "SAUDE") {
            $path = "assets/images/saude.png";
        } else if ($token == "TURISMO") {
            $path = "assets/images/turismo.png";
        } else if ($token == "TRANSPORTE") {
            $path = "assets/images/transporte.png";
        } else if ($token == "INFRAESTRUTURA") {
            $path = "assets/images/infraestrutura.png";
        } else if ($token == "MEIO_AMBIENTE") {
            $path = "assets/images/meio_ambiente_2.png";
        } else if ($token == "SHOP") {
            $path = "assets/images/compras.png";
        } else if ($token == "CULTURA") {
            $path = "assets/images/cultura.png";
        } else if ($token == "BEER") {
            $path = "assets/images/ipa.png";
        } else if ($token == "EDUCACAO") {
            $path = "assets/images/educacao.png";
        } else if ($token == "ESPORTE") {
            $path = "assets/images/esportes.png";
        } else if ($token == "ALIMENTACAO") {
            $path = "assets/images/alimentacao.png";
        } else if ($token == "IMOVEIS") {
            $path = "assets/images/imoveis.png";
        }
        $img = "<img src=" . $path . ">";

        echo $img;
    }

    public static final function getImagePathFromToken($token) {
        $path = "";
        if ($token == "SEGURANCA") {
            $path = "./assets/images/seguranca.png";
        } else if ($token == "SAUDE") {
            $path = "./assets/images/saude.png";
        } else if ($token == "TURISMO") {
            $path = "./assets/images/turismo.png";
        } else if ($token == "TRANSPORTE") {
            $path = "./assets/images/transporte.png";
        } else if ($token == "INFRAESTRUTURA") {
            $path = "./assets/images/infraestrutura.png";
        } else if ($token == "MEIO_AMBIENTE") {
            $path = "./assets/images/meio_ambiente_2.png";
        } else if ($token == "SHOP") {
            $path = "./assets/images/compras.png";
        } else if ($token == "CULTURA") {
            $path = "./assets/images/cultura.png";
        } else if ($token == "BEER") {
            $path = "./assets/images/ipa.png";
        } else if ($token == "EDUCACAO") {
            $path = "./assets/images/educacao.png";
        } else if ($token == "ESPORTE") {
            $path = "./assets/images/esportes.png";
        } else if ($token == "ALIMENTACAO") {
            $path = "./assets/images/alimentacao.png";
        } else if ($token == "IMOVEIS") {
            $path = "./assets/images/imoveis.png";
        }


        echo $path;
    }

    public static final function getImageTokenPkFacebook($url, $redirec = false) {
        $imagename = local_directory . "avatar.jpg";
        $file = $url;

        if (!copy($file, $imagename)) {
            echo "Failed to copy $file";
        } else {
            // echo "Copied Profile Picture";
        }

        $imageToken = ProfileManager::loadImageKey($imagename, $redirec);
        //Token
        return $imageToken;
    }

    public static final function getImageTokenPkGoogle($url, $redirec = false) {
        $imagename = "../" . local_directory . "avatar.jpg";
        $file = $url;

        if (!copy($file, $imagename)) {
            echo "Failed to copy $file";
        } else {
            // echo "Copied Profile Picture";
        }

        $imageToken = ProfileManager::loadImageKeyG($imagename, $redirec);
        //Token
        return $imageToken;
    }

    public static final function loadImageKeyG($imagePath, $redirec = false) {
        $upload = "http://gaeloginendpoint.appspot.com/upload.exec";
        $jsonRet = "../" . file_get_contents($upload);
        $jsonObjet = json_decode($jsonRet);
        //var_dump($jsonRet);
        $handle = fopen("../" . local_directory . "avatar.jpg", "r");
        $url = "$jsonObjet->uploadPath";

        $post_array = array(
            "myFile" => curl_file_create("../" . local_directory . "avatar.jpg", 'image/jpeg', 'avatar.jpg'),
            "upload" => "avatar.jpg"
        );
        $ch = ProfileManager::retCURL($post_array, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
        $response = curl_exec($ch);
        //echo $response."=>RESPONSE";

        return ProfileManager::saveImageBigData($response, $url);
    }

}

?>