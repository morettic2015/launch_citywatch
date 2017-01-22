<style>

</style>
<script type="text/javascript">
    var options = {
        enableHighAccuracy: true,
        timeout: 10000,
        maximumAge: 0
    };
    function success(pos) {
        initMap(pos);
    }
    navigator.geolocation.getCurrentPosition(success, success, options);
    var localizacao = null;
    var map = null;
    function initMap(pos) {
        alert(crd);
        var crd = pos.coords;
        map = new google.maps.Map(document.getElementById('map1'), {
            center: {lat: crd.latitude, lng: crd.longitude},
            zoom: 13
        });
        var input = /** @type {!HTMLInputElement} */(
                document.getElementById('pac-input'));

        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });
        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setIcon(/** @type {google.maps.Icon} */ ({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            localizacao = {lat: place.geometry.location.lat(), lon: place.geometry.location.lng()}
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
            var radioButton = document.getElementById(id);
            radioButton.addEventListener('click', function () {
                autocomplete.setTypes(types);
            });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);


    }
    function submitForm() {
        document.ponto.lat.value = localizacao.lat;
        document.ponto.lon.value = localizacao.lon;

        alert(document.ponto.lon.value);
    }
</script>
<div class="landindPage_lead1">
    <h1 class="whiteOne tit_landind">Pontos de interesse</h1>
    <h2 class="whiteOne subtit_landind">Registre os pontos de seu interesse <br>e compartilhe sua experiência com quem está próximo!</h2>
</div>
<div id="newsletterform">

    <?php
    /**
     * Sucess message
     */
    if (!empty($_GET['fTit'])) {
        ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
            Ponto de interesse salvo com sucesso.
        </div>
        <?php
    }
    ?>
    <form method="GET" name="ponto" action="index.php" data-ajax="false" onsubmit="submitForm()">
        <fieldset class="ui-field-contain">
            <label for="fTit">Título:</label>
            <input type="text" name="fTit" id="fTit"  placeholder="Título de sua experiência">
            <label for="fDesc">Descrição:</label>
            <textarea type="text" name="fDesc" id="fDesc"  placeholder="Descricao"></textarea>
            <label for="fFoto1">Imagem</label>
            <input id="fFoto1" name="fFoto1" type="file">

            <label for="fTipo">Contexto da experiência</label>
            <select name="fTipo" id="fTipo">
                <?php
                $tpList = ProfileManager::typeList();
                $vet = $tpList->types;
                foreach ($vet as $objeto) {
                    ?>
                    <option value="<?php echo @$objeto ?>"><?php echo @$objeto; ?></option>
                    <?php
                }
                ?>
            </select>
            <br>
            <input type="hidden" name="lat" value="">
            <input type="hidden" name="lon" value="">
            <input type="hidden" name="p" value="new_experience">
            <input id="pac-input" name="endereco" class="controls" type="text" placeholder="Localização da experiência">
            <div id="map1">
            </div>

        </fieldset>
        <div data-role="controlgroup" data-type="horizontal" data-mini="true" align="right">
            <input type="submit" name="Salvar" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-check ui-btn-b" data-theme="g" value="Salvar">
            <input type="reset" name="Resetar" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-delete ui-btn-b" data-theme="e" value="Cancelar">
        </div>
    </form>
</div>
<div class="landindPage_who">
    <h1 class="whiteOne tit_landind">Minhas experiências</h1>
    <h2 class="whiteOne subtit_landind">Seus pontos de interesse e experiências compartilhadas</h2>
</div>
<div id="newsletterform">
    <ul data-role="listview" data-inset="true">
        
        <!-- http://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=32&id=5660531612450816 -->
        <li>
            <a href="#">
                <h2>Symbian</h2>
                <p>Nokia confirms the end of Symbian</p>
                <p class="ui-li-aside">Symbian</p>
            </a>
        </li>
    </ul>
</div>