<?php

/**

 * Profile manager
 * @Connect to the webservice from gae to create ACC
 * 
 *  */
const local_directory = '../dir/';

class ProfileManager {

    var $tipoProfile = array("GOOGLE", "TWITTER", "FACEBOOK");
    var $mProfileSource = null;

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

    function getAvatar() {
        if ($this->mProfileSource == $this->tipoProfile[2]) {
            return "https://graph.facebook.com/" . $_SESSION["FBID"] . "/picture";
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

        echo "<pre>";
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
        $handle = fopen(local_directory."avatar.jpg", "r");
        $url = "$jsonObjet->uploadPath";
        echo "URL_UPLOAD=>".$url;
        
        //$postfields = array("filedata" => "$handle", "filename" => '$handle');
//Faz o upload
       // var_dump($handle);
        
        
//most importent curl assues @filed as file field
        $post_array = array(
            "myFile" => curl_file_create(local_directory."avatar.jpg",'image/jpeg','avatar.jpg'),
            "upload" => "avatar.jpg"
        );
        $ch = ProfileManager::retCURL($post_array, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
        $response = curl_exec($ch);
        echo $response."=>RESPONSE";
        
        //return ProfileManager::saveImageBigData($response, $url);
    }

    public static final function saveImageBigData($response, $url) {
        $url = "https://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=2&iName=airport.jpg&iToken=$response";
        $jsonRet = file_get_contents($url);
        $jsonObjet = json_decode($jsonRet);
        return $jsonObjet->key;
    }

    public static final function getImageTokenPkFacebook($url, $redirec = false) {
        $imagename = local_directory."avatar.jpg";
        $file = $url;

        if (!copy($file, $imagename)) {
            echo "failed to copy $file";
        } else {
            echo "Copied Profile Picture";
        }

        $imageToken = ProfileManager::loadImageKey($imagename, $redirec);
        //Token
        return $imageToken;
    }

}

?>