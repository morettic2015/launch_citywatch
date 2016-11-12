<?php

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

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
var_dump($connection);

$url = $connection->url("oauth/authorize", ["oauth_token" => "EaQLH34YD8pgKkUiSp8RbjjOgNxIYVh7"]);

var_dump($url);
?>