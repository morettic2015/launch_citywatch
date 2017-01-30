<?php
session_start();
$geoLocation = ProfileManager::getJsonFromLatLon();
$tpList = ProfileManager::typeList();
?>
<div class="landindPage_lead1">
    <img src="./assets/images/search.svg" class="ico_landind"/>
    <h1 class="whiteOne tit_landind">Pesquisar</h1>
    <h2 class="whiteOne subtit_landind">Selecione as categorias, distância <br>para localizar <!-- eventos e --> pontos de interesse </h2>
</div>
<div  class="barra_up">
    <img src="./assets/images/Cinza11_1.svg" style="width: 100%"/>
</div>
<div class="landindPage_carac">
    <div id="newsletterform">
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
                </select>
            </div>
            <div data-role="fieldcontain">
                <div data-role="rangeslider" data-mini="true">
                    <label for="range">Distância (KM):</label>
                    <input type="range" name="range" id="range" min="1" max="100" value="0">
                </div>
            </div>
            <!--    <div data-role="fieldcontain">
                    <label for="event">Pesquisar eventos:</label>
                    <input type="checkbox" name="event" id="event"/>
                </div>
                <div data-role="fieldcontain">
                    <label for="data1">Data inicial do evento:</label>
                    <input type="date" name="data1" id="data1"/>
                </div>
                <div data-role="fieldcontain">
                    <label for="data2">Data final do evento:</label>
                    <input type="date" name="data2" id="data2"/>
                </div> -->
            <div data-role="controlgroup" data-type="horizontal" data-mini="true" align="right">
                <input type="submit" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-search ui-btn-b" data-theme="g" value="Filtrar">
                <input type="reset" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-delete ui-btn-b" data-theme="f" value="Cancelar">
            </div>
        </form>
    </div>
</div>