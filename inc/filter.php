<?php
session_start();
//var_dump($_SESSION);
//include './src/ProfileManager.php';

$geoLocation = ProfileManager::getJsonFromLatLon();


//echo $email;
//var_dump($email);
$tpList = ProfileManager::typeList();
?>
<div id="newsletterform">
    <h1 style="margin-top: 100px;font-size: 30px" class="ui-btn ui-icon-search ui-btn-icon-top"  data-theme="f" >Pesquisar</h1>
    <small>
        Atualmente sua localização aproximada é: <?php echo $geoLocation->city; ?> (<?php echo $geoLocation->lat; ?>,<?php echo $geoLocation->lon; ?>)
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
        <div data-role="fieldcontain">
            <label for="canais[]">Categorias:</label>
            <select name="canais[]" id="canais[]" data-native-menu="false" data-mini="true" multiple="multiple" size="4">
                <?php
                $vet = $tpList->types;
                foreach ($vet as $objeto) {
                    ?>
                    <option value="<?php echo @$objeto ?>"><?php echo @$objeto; ?></option>
                    <?php
                }
                ?>
                ?>
            </select>
        </div>
        <div data-role="fieldcontain">
            <div data-role="rangeslider" data-mini="true">
                <label for="range">Distância (KM):</label>
                <input type="range" name="range" id="range" min="50" max="2000" value="0">
            </div>
        </div>
        <div data-role="controlgroup" data-type="horizontal" data-mini="true" align="right">
            <input type="submit" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-search ui-btn-b" data-theme="g" value="Filtrar">
            <input type="reset" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-delete ui-btn-b" data-theme="f" value="Cancelar">
        </div>
    </form>
</div>
<!--
</div>
</body>
</html> -->