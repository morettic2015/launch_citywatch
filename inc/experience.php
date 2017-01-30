<link href="assets/css/style2.css" rel="stylesheet" />
<div class="landindPage_lead1">
    <img src="./assets/images/point.svg" class="ico_landind"/>
    <h1 class="whiteOne tit_landind">Pontos de interesse</h1>
    <h2 class="whiteOne subtit_landind">Registre os pontos de seu interesse <br>e compartilhe sua experiência com quem está próximo!</h2>
</div>
<div  class="barra_up">
    <img src="./assets/images/Cinza11.svg" style="width: 100%"/>
</div>
<div id="newsletterform">;
    <?php
    /**
     * Sucess message
     */
    if (!empty($_GET['fTit'])) {

        ProfileManager::saveLocation($tit = $_GET['fTit'], $lat = $_GET['lat'], $lon = $_GET['lon'], $desc = $_GET['fDesc'], $fi = $_GET['fNames'], $tp = $_GET['fTipo'], $addrs = $_GET['endereco'], $id = $_GET['idProfile'], $chkv = $_GET['chkEvento']);
        ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
            Ponto de interesse salvo com sucesso.
        </div>
        <?php
    }
    ?>
    <div id="ctrErro" class="alertRed">
    </div>
    <h3>Conte sua história</h3>

    <form method="GET" name="ponto" action="index.php" data-ajax="false">

        <fieldset class="ui-field-contain">
            <div data-role="fieldcontain">
                <label for="fTit">Nome do local:</label>
                <input type="text" name="fTit" id="fTit"  placeholder="Nome do local ou título da experiência">
            </div>
            <div data-role="fieldcontain">
                <label for="checkbox-empresa">Foi um evento?</label>
                <input type="checkbox" id="checkbox-empresa" data-role="flipswitch" name="chkEvento">
            </div>
            <div data-role="fieldcontain">
                <label for="fDesc">Experiência:</label>
                <textarea type="text" name="fDesc" id="fDesc"  placeholder="Descreva a experência nesse local"></textarea>
            </div>
            <div data-role="fieldcontain">

                <label for="fTipo">Contexto da experiência</label>
                <select name="fTipo" id="fTipo" data-native-menu="false">
                    <option selected></option>
                    <?php
                    $tpList = ProfileManager::typeList();
                    $vet = $tpList->types;
                    foreach ($vet as $objeto) {
                        ?>
                        <option value="<?php echo @$objeto; ?>"><?php echo @$objeto; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <br>
            </div>

            <div data-role="fieldcontain">
                <label for="fFoto1">Imagens selecione até 4 imagens da experiência</label>
                <a href="#popImagens" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-transition="pop">
                    <img src="./assets/images/pics.png">
                </a>
            </div>
            <h3>Localização</h3>
            <input type="hidden" name="lat" value="">
            <input type="hidden" name="lon" value="">
            <input type="hidden" name="p" value="experience">
            <input type="hidden" name="fNames" value="">
            <input type="hidden" name="idProfile" value="<?php echo $_SESSION['profile']->key; ?>">
            <input id="pac-input" name="endereco" class="controls" type="text" placeholder="Localização da experiência">
            <div data-role="fieldcontain">
                <div id="map1">
                </div>
            </div>

        </fieldset>
        <div data-role="controlgroup" data-type="horizontal" data-mini="true" align="right">
            <a href="javascript:submitForm()" data-rel="popup" class="ui-shadow ui-btn ui-corner-all ui-btn-g" data-theme="g" >Salvar</a>
            <input type="button" name="Excluir" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-check ui-btn-b" data-theme="b" value="Excluir">
            <input type="reset" name="Resetar" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-delete ui-btn-b" data-theme="e" value="Cancelar">
        </div>
    </form>
    <div data-role="popup" id="popImagens">
        <form id="upload" method="post" action="./src/upload.php" enctype="multipart/form-data">
            <div id="drop">
                Arraste aqui

                <a>Selecione as imagens</a>
                <input type="file" name="upl" multiple />
            </div>

            <ul>
                <!-- The file uploads will be shown here -->
            </ul>

        </form>
    </div>
</div>
<div  class="barra_up">
    <img src="./assets/images/Cinza_claro12_inner.svg" style="width: 100%"/>
</div>
<div class="landindPage_who">
    <img src="./assets/images/docs.svg" class="ico_landind"/>
    <h1 class="whiteOne tit_landind">Minhas experiências</h1>
    <h2 class="whiteOne subtit_landind">Seus pontos de interesse e experiências compartilhadas</h2>
    <div id="newsletterform">
        <ul data-role="listview" data-inset="true">

            <!-- http://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=32&id=5660531612450816 -->


            <?php
            $experiences = ProfileManager::gExperience($myKey = $_SESSION['profile']->key);
            //var_dump($experiences);
            $vet = $experiences->result;
            //var_dump($vet);
            foreach ($vet as $objeto) {
                ?>
                <li>
                    <a href="#">
                        <h2><?php echo $objeto->tit; ?></h2>
                        <p><?php echo $objeto->desc; ?></p>
                        <p class="ui-li-aside"><?php echo $objeto->tipo; ?></p>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="./assets/js/jquery.knob.js"></script>

<!-- jQuery File Upload Dependencies -->
<script src="./assets/js/jquery.ui.widget.js"></script>
<script src="./assets/js/jquery.iframe-transport.js"></script>
<script src="./assets/js/jquery.fileupload.js"></script>

<!-- Our main JS file -->
<script src="./assets/js/upload.js"></script>
<script src="./assets/js/experience.js"></script>