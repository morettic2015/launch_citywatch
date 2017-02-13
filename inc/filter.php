<?php
session_start();
$geoLocation = ProfileManager::getJsonFromLatLon();
$tpList = ProfileManager::typeList();
?>
<a href="#popupSrc" data-rel="popup" data-transition="slideup"  class="ui-btn ui-corner-all ui-btn-inline ui-shadow  ui-icon-search ui-btn-icon-notext ui-mini" >icon only button</a>
<div data-role="popup" id="popupSrc">
    <h2>Pesquisar Experiências</h2>
    <small>
        Localização aproximada:<br><?php echo $geoLocation->city; ?> (Latitude <?php echo $geoLocation->lat; ?>, Longitude <?php echo $geoLocation->lon; ?>)
    </small>
    <form method="POST" action="./?p=gmaps" data-ajax="false">

        <input type="hidden" value="gmaps" name="p">
        <input type="hidden" value="<?php echo $_SESSION['profile']->key; ?>" name="idProfile">
        <input type="hidden" value="<?php echo $geoLocation->lat; ?>" name="lat">
        <input type="hidden" value="<?php echo $geoLocation->lon; ?>" name="lon">
        <input type="hidden" value="<?php echo $geoLocation->city; ?>" name="city">
        <!-- <div data-role="fieldcontain">
             <label for="keywords">Palavra chave:</label>-->
        <input type="hidden" name="keywords" id="keywords" value="" placeholder="ex: taxi" data-mini="true">
        <!--    </div> -->
        <div data-role="fieldcontain" data-theme="d">
            <fieldset data-role="controlgroup" data-type="vertical" data-mini="true">
               <!-- <select style="visibility: hidden;display: none" name="canais[]" id="canais[]" multiple="multiple"> -->
                <?php
                $email = strtoupper(ProfileManager::getEmail1());
                $p1 = ProfileManager::iDoExist($email);
                $conf = $p1->config;
                $hashMap = array();
                if (!empty($p1->config)) {

                    foreach ($conf as $post) {
                        $hashMap[$post] = $post;
                    }
                }
                $vet = $tpList->types;
                foreach ($vet as $objeto) {
                    $selected = isset($hashMap[$objeto]) ? "checked" : "";
                    ?>
                    <label>
                        <input type="checkbox" <?php echo @$selected; ?> value="<?php echo @$objeto ?>" id="<?php echo @$objeto ?>" name="<?php echo @$objeto ?>">
                        <?php echo @$objeto; ?>
                    </label>
                    <?php
                }
                ?>
                <!--</select>-->
            </fieldset>
        </div>
        <div data-role="fieldcontain">
            <div data-role="rangeslider" data-mini="true">
                <label for="range">Distância (KM):</label>
                <input type="range" name="range" id="range" min="1" max="100" value="50">
            </div>
        </div>

        <div data-role="controlgroup" data-type="horizontal" data-mini="true" align="right">
            <input type="submit" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-search ui-btn-b" data-theme="g" value="Filtrar">
        </div>
    </form>
</div>