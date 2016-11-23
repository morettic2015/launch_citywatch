<?php
session_start();
//var_dump($_SESSION);
//include './src/ProfileManager.php';

$geoLocation = ProfileManager::getJsonFromLatLon();

//var_dump($geoLocation);
?>
<!doctype html>
<!-- <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>www.Citywatch.com.br</title>
        <link href="http://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <link rel="stylesheet" href="../assets/css/style.css">

        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

    </head>
    <body>
        <div data-role="page" data-dialog="true">

            <div data-role="header" data-theme="a">
                <h1>Filtro</h1> 
            </div>

            <div role="main" class="ui-content"> -->
<div id="newsletterform">
    <h1>Filtro</h1>
    <small>
        Atualmente sua localização aproximada é: <?php echo $geoLocation->city; ?> (<?php echo $geoLocation->lat; ?>,<?php echo $geoLocation->lon; ?>)
    </small>
    <form method="GET" action="./">
        <label for="canais[]"  class="ui-hidden-accessible " >
            Selecione uma ou mais categorias:
            <br>

        </label>
        <input type="hidden" value="gmaps" name="p">
        <input type="hidden" value="<?php echo $_SESSION['profile']->key; ?>" name="idProfile">
        <input type="hidden" value="<?php echo $geoLocation->lat; ?>" name="lat">
        <input type="hidden" value="<?php echo $geoLocation->lon; ?>" name="lon">
        <input type="hidden" value="<?php echo $geoLocation->city; ?>" name="city">
        <label for="basic">Palavra chave:</label>
        <input type="text" name="keywords" id="keywords" value="" placeholder="ex: taxi" data-mini="true">
        Ou selecione uma ou mais categorias!
        <select name="canais[]" id="canais[]" data-native-menu="false" data-mini="true" multiple="multiple" size="4">
            <option>Categorias</option>
            <option value="SEGURANCA">Segurança</option>
            <option value="SAUDE">Saúde</option>
            <option value="TURISMO">Turismo</option>
            <option value="TRANSPORTE">Transporte</option>
            <option value="INFRAESTRUTURA">Infraestrutura</option>
            <option value="MEIO_AMBIENTE">Meio Ambiente</option>
            <option value="SHOP">Shopping</option>
            <option value="CULTURA">Cultura</option>
            <option value="BEER">Cervejas</option>
            <option value="EDUCACAO">Educação</option>
            <option value="ESPORTE">Esportes</option>
            <option value="ALIMENTACAO">Alimentação</option>
            <option value="IMOVEIS">Imoveis</option>
        </select>

        <div data-role="rangeslider" data-mini="true">
            <label for="range">Distância (KM):</label>
            <input type="range" name="range" id="range" min="10" max="50" value="0">
        </div>
        <div data-role="controlgroup" data-type="horizontal" data-mini="true" align="right">
            <input type="submit" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-search ui-btn-b" value="Filtrar">
            <input type="reset" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-delete ui-btn-b" value="Cancelar">
        </div>
    </form>
</div>
<!--
</div>
</body>
</html> -->