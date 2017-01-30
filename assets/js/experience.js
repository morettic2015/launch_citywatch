/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
    //alert(crd);
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
var mensagemErro = "";
var fileName = "";
var ctrErro = document.getElementById('ctrErro');

var tit = document.ponto.fTit;
var desc = document.ponto.fDesc;
var tipo = document.ponto.fTipo;
var evento = document.ponto.chkEvento;
var fNames = document.ponto.fNames;

function submitForm() {
    mensagemErro = "";
    ctrErro.innerHTML = " <span class='closebtn' onclick='this.parentElement.style.display = \"none\";'>&times;</span>";

    if (tit.value == "") {
        mensagemErro += "Informe o nome do local<br>";
    }
    if (desc.value == "") {
        mensagemErro += "Descreva a experiência<br>";
    }
    if (tipo.value == "") {
        mensagemErro += "Selecione o contexto da experiência<br>";
    }
    if (uploadDataFiles.length < 1) {
        mensagemErro += "Selecione uma imagem de sua experiência<br>";
    }
    if (localizacao == null) {
        mensagemErro += "Selecione a localização<br>";
    } else {
        document.ponto.lat.value = localizacao.lat;
        document.ponto.lon.value = localizacao.lon;
    }
    for (i = 0; i < uploadDataFiles.length; i++) {
        fileName += uploadDataFiles[i].files[0].name + ",";
    }
    fNames.value = fileName;
    if (mensagemErro == "") {
        document.ponto.submit();
    } else {
        ctrErro.innerHTML += mensagemErro;
        ctrErro.style.display = "block";
    }
    return false;
}
