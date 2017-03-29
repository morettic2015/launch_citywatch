<?php
$geoLocation = ProfileManager::getJsonFromLatLon();
//var_dump($geoLocation);
$param = urlencode($geoLocation->city);
$url = "http://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=16&city=$param";
//echo $url;
//
//echo "<pre>";
$jsonRet = file_get_contents($url);
$listNow = json_decode($jsonRet);
//var_dump($listNow);
//die();
?>
<div class="landindPage_lead1"><?php echo $geoLocation->city; ?>
    <img src="./assets/images/search.svg" class="ico_landind"/>
    <h1 class="whiteOne tit_landind">Novidades</h1>
    <h2 class="whiteOne subtit_landind">Veja as novidades da rede perto de você</h2>
</div>
<div  class="barra_up">
    <img src="./assets/images/Cinza11_1.svg" style="width: 100%"/>
</div>
<div class="landindPage_carac">
    <div id="newsletterform">


        <!-- http://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=32&id=5660531612450816 -->
        <h1>Sua localização aproximada é: <?php echo $_SESSION['location']->city . ',' . $_SESSION['location']->country; ?></h1>

        <?php
        $twitterList = $listNow->tList;
        if (!empty($listNow->tList)) {
            echo "<h1>Twitter news</h1>";
            echo '<ul data-role="listview" data-inset="true">';
            foreach ($twitterList as $objeto) {
                ?>
                <li>
                    <a href="#">
                        <h2><? echo $objeto->twitter_user; ?></h2>
                        <p><? echo $objeto->text; ?></p>
                        <p><img src="<? echo $objeto->avatar_url; ?>" style="clip-path: rect(10px, 20px, 30px, 40px);width:60px;"/></p>
                        <p class="ui-li-aside"><? echo $objeto->created_at; ?></p>
                    </a>
                </li>
                <?
            }
            echo "</ul>";
        }
        $twitterList = $listNow->rList;
        if (!empty($listNow->rList)) {
            echo "<h1>Citywatch news</h1>";
            echo '<ul data-role="listview" data-inset="true" data-theme="d">';
            foreach ($twitterList as $objeto) {
                ?>
                <li>
                    <a href="#">
                        <h2><? echo $objeto->tit; ?></h2>
                        <p><? echo $objeto->desc; ?></p>
                        <p><img src="<? echo $objeto->token; ?>" style="clip-path: rect(10px, 20px, 30px, 40px);width:60px;"/></p>
                        <p>Author: <? echo $objeto->author; ?></p>
                        <p><? echo $objeto->date; ?></p>
                    </a>
                </li>
                <?
            }
            echo "</ul>";
        }
        ?>

    </div>
</div>