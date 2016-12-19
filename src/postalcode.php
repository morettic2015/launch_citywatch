<?php
header('Content-Type: application/json');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$postalcode = $_GET['code'];
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$postalcode&sensor=true";
$jsonRet = file_get_contents($url);
$jsonObjet = json_decode($jsonRet);

//var_dump($jsonObjet->rows);
//echo "<pre>";

$vet = $jsonObjet->results[0]->address_components;
$strLocalTmp = "NULL";
$localeInfo = new stdClass();
foreach ($vet as $value) {

    //var_dump($value->types);

    if ($value->types[0] == "postal_code") {
        $localeInfo->postal_code = $value->long_name;
    } else if ($value->types[0] == "locality" || $value->types[0] == "administrative_area_level_2") {
        $localeInfo->city = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$value->long_name);
    } else if ($value->types[0] == "administrative_area_level_1") {
        $localeInfo->state = $value->long_name;
    } else if ($value->types[0] == "country") {
        $localeInfo->country = $value->long_name;
    } else if ($value->types[0] == "sublocality_level_1" || $value->types[0] == "administrative_area_level_3") {
        $localeInfo->bairro = $value->long_name;
    } else if ($value->types[0] == "postal_code") {
        
    }
}
if (is_null($localeInfo->bairro)) {
    $localeInfo->bairro = "";
}
if (is_null($localeInfo->city)) {
    $localeInfo->city = "";
}
if (is_null($localeInfo->postal_code)) {
    $localeInfo->postal_code = "";
}
if (is_null($localeInfo->country)) {
    $localeInfo->country = "";
}
if (is_null($localeInfo->state)) {
    $localeInfo->state = "";
}

echo json_encode($localeInfo);
?>
