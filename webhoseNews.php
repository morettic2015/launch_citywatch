<?php

//Define the output as JSON
header('Content-Type: application/json');

class Webhose {

    var $fileName = "webhose.json";

    private function getUrlFromQuery($queryParameters) {
        $queryParametersEncoded = urlencode($queryParameters);
        $urlReq = "https://webhose.io/search?token=1fc216b6-77ed-4ab8-8afb-a3ba12a44e09&format=json&q=$queryParametersEncoded%20performance_score%3A%3E0&ts=1463083786912";

        $jsonRet = file_get_contents($urlReq);
        $jsonObjet = json_decode($jsonRet);

        return $jsonObjet;
    }

    private function getLatLonFromUrl($url) {
        $furl = "http://ip-api.com/json/" . $url;
        $jsonRet = file_get_contents($furl);
        $jsonObjet = json_decode($jsonRet);

        return $jsonObjet;
    }

    public function getResult($q) {
        $cache = './dir/' . date("h") . '_' .$q.'_' . $this->fileName;
        if (file_exists($cache)) {
            $ret = file_get_contents($cache);
            //echo $json;
            //$ret = json_decode($json, true);
        } else {

            $json = $this->getUrlFromQuery($q);
            $vet = $json->posts;
            $this->map = array();
            $cont = 0;
            $markers = array();
            foreach ($vet as $object) {
                /* echo "<pre>";
                  var_dump($object);die(); */
                if (!isset($this->map[$object->thread->site_full])) {
                    $this->map[$object->thread->site_full] = $this->getLatLonFromUrl($object->thread->site_full);
                }
                $cont++;
                $jsList = new stdClass();
                $jsList->id = $object->thread->uuid;
                $jsList->token = $object->thread->main_image;
                $jsList->title = $object->thread->title;
                $jsList->date = $object->published;
                $jsList->text = mb_convert_encoding(substr($object->text, 0, 140), "UTF-8");
                $jsList->author = $object->author;
                $jsList->country = $this->map[$object->thread->site_full]->country;
                $jsList->city = $this->map[$object->thread->site_full]->city;
                $jsList->lat = $this->map[$object->thread->site_full]->lat;
                $jsList->lon = $this->map[$object->thread->site_full]->lon;
                $jsList->idWebPage = $cont;
                if ($jsList->lat == "" || $jsList->lon == "") {
                    continue;
                }

                $markers[] = $jsList;
                // $phrases = explode(".", $text);
                if ($cont > 100)
                    break;
            }
            $ret = json_encode($markers);
            /**
             * @saves on cache
             */
            $myfile = fopen($cache, "w");
            fwrite($myfile, $ret);
            fclose($myfile);
        }

        return $ret;
    }

}

$query = $_GET['query'];
$webCrawler = new Webhose();
echo $webCrawler->getResult($query);
?>