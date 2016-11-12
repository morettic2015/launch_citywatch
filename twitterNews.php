<?php

//Define the output as JSON
header('Content-Type: application/json');

//Include required lib from twitter
require "./autoload.php";

//Define apo
use Abraham\TwitterOAuth\TwitterOAuth;

//COnfig app Keys
        const CONSUMER_KEY = "OzVHL0WiRfdoa4FDkjSTWWP5g";
        const CONSUMER_SECRET = "EfEIRwJ3YcKkSj1B8bWgKGp5G6gyofphzPiSOaI8ZfTXktWKtO";
        const access_token = "26237051-e4xzwiRXxLiHozzK6Mb3NLOGeSqR8ztvXOw3QIGqf";
        const access_token_secret = "vfilWJ5OPvWPapE1IJt2TfcfMivRZ9XRqJCj3m98BpVHk";

//recover the parameter


class TwitterWebService {

    var $markers = array();

    /**
      search twitter feed by key word
     *      */
    function loadGeoTweets($query_parameter) {
        //Twitter OAuth - requires token from dev.twitter.com
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
        //prepare the query and set the max results
        $parameters = array('q' => $query_parameter, 'result_type' => 'mixed', 'count' => 100);
        $content = $connection->get('search/tweets', $parameters);
        //var_dump($content);
        $vet = $content->statuses;
        $total = 0;

        $ia = 0;
        foreach ($vet as $objeto) {
            if (is_null($objeto->place) && is_null($objeto->geo) && is_null($objeto->user->geo) && is_null($objeto->coordinates)) {
                continue;
            }
            
            $mOcorrencia = new stdClass();
            $mOcorrencia->id = $objeto->id;
            $mOcorrencia->text = $objeto->text;
            $mOcorrencia->created_at = $objeto->created_at;
            $mOcorrencia->latitude = $this->midpoint(
                    $objeto->place->bounding_box->coordinates[0][0][1], $objeto->place->bounding_box->coordinates[0][1][1], 
                    $objeto->place->bounding_box->coordinates[0][2][1], $objeto->place->bounding_box->coordinates[0][3][1]);
            $mOcorrencia->longitude = $this->midpoint(
                    $objeto->place->bounding_box->coordinates[0][0][0], $objeto->place->bounding_box->coordinates[0][1][0], 
                    $objeto->place->bounding_box->coordinates[0][2][0], $objeto->place->bounding_box->coordinates[0][3][0]);
            $mOcorrencia->media = $objeto->entities->media[0]->media_url;
            $mOcorrencia->author = $objeto->user->name;
            $mOcorrencia->twitter_user = $objeto->user->screen_name;
            $mOcorrencia->user_location = $objeto->user->location;
            $mOcorrencia->user_desc = $objeto->user->description;
            $mOcorrencia->avatar_url = $objeto->user->profile_image_url;

            $mOcorrencia->logoDefault = "http://citywatch.com.br/v1/assets/images/logo.png";
            $mOcorrencia->geo_error = false;
            ;
            if ($mOcorrencia->latitude == "" || $mOcorrencia->longitude == "") {
                $mOcorrencia->geo_error = true;
            }
            //Add the point to the vector;
            $this->markers[] = $mOcorrencia;
        }
        return $this->markers;
    }

    function midpoint($lat1, $lng1, $lat2, $lng2) {

        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        $dlng = $lng2 - $lng1;
        $Bx = cos($lat2) * cos($dlng);
        $By = cos($lat2) * sin($dlng);
        $lat3 = atan2(sin($lat1) + sin($lat2), sqrt((cos($lat1) + $Bx) * (cos($lat1) + $Bx) + $By * $By));
        $lng3 = $lng1 + atan2($By, (cos($lat1) + $Bx));
        $pi = pi();
        return (($lat3 * 180) / $pi + ($lng3 * 180) / $pi) / 2;
    }

}

/**

 *  Call webservice
 *  */

$query_parameter = $_GET['query'];
$twitterWebservice = new TwitterWebService();

$markers = $twitterWebservice->loadGeoTweets($query_parameter);
echo json_encode($markers);
?>