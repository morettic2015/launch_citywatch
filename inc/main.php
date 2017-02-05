
<div class="landindPage noSpace">

    <div id="newsletterform" class="noSpace" >
        <center >
            <!-- <h1  class="whiteOne" style="margin-top: 200px;">CITY WATCH</h1> -->
            <h1  class="whiteOne homeBigTit">COMPARTILHANDO EXPERIÊNCIAS<br>PELAS CIDADES! </h1>
        </center>
    </div>
    <img src="./assets/images/Preto12.svg" style="width: 100%"/>
</div>
<div class="landindPage_video">
    <div id="newsletterform" class="noSpace" >
        
        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.citywatch.com.br%2F&width=192&layout=button_count&action=like&size=large&show_faces=false&share=true&height=46&appId=291386861194854" width="192" height="46" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>   

        <div class="columnsContainer" >

            <div class="leftColumn">
                <!--<h1 class="whiteOne ui-corner-all" style="margin-bottom: 20px;margin-top: 80px">Apresentação</h1> -->
                <h4 class="whiteOne" style="margin-bottom: 20px;margin-top: 80px">Já imaginou se perder na cidade <br>e acabar em uma roubada?<br><br>Quer achar os seus pontos de interesse <br>e receber promoções perto de você? </h4>
            </div>

            <div class="rightColumn">
                <div class="video-container">
                    <iframe class="youtubeMaster" src="https://www.youtube.com/embed/FmRzvyr3AAs?controls=1&showinfo=0&rel=0&autoplay=1&loop=0" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="landindPage_carac">
    <img src="./assets/images/Preto11.svg" style="width: 100%"/>
    <div id="newsletterform" class="noSpace" >
        <h1>
            CATEGORIAS
        </h1>
        <h3>Conheça as categorias do APP e saiba como elas podem ser úteis para você.</h3>
        <p>
            Explore as categorias abaixo e descubra o contexto de uso. Veja como elas podem ser úteis no seu dia a dia pelas cidades.
        </p>
        <div data-role="navbar" style="margin-bottom: 100px">
            <ul>
                <li><a href="#./inc/seguranca.html" data-transition="pop"><img  src="assets/images/seguranca.png"/><br>Segurança</a></li>
                <li><a href="#./inc/saude.html" data-transition="pop"><img  src="assets/images/saude.png"/><br>Saúde</a></li>
                <li><a href="#./inc/turismo.html" data-transition="pop"><img  src="assets/images/turismo.png"/><br>Turismo</a></li>
                <li><a href="#./inc/transporte.html" data-transition="pop"><img  src="assets/images/transporte.png"/><br>Transporte</a></li>
            </ul>
            <ul>
                <li><a href="#./inc/infra.html" data-transition="pop"><img  src="assets/images/infraestrutura.png"/><br>Infraestrutura</a></li>
                <li><a href="#./inc/meio_ambiente.html" data-transition="pop"><img  src="assets/images/meio_ambiente_2.png"/><br>Meio ambiente</a></li>
                <li><a href="#./inc/shopping.html" data-transition="pop"><img  src="assets/images/compras.png"/><br>Shop</a></li>
                <li><a href="#./inc/cultura.html" data-transition="pop"><img  src="assets/images/cultura.png"/><br>Cultura</a></li>
                <li><a href="#./inc/cervejas.html" data-transition="pop"><img  src="assets/images/ipa.png"/><br>Cervejas</a></li>
            </ul>
            <ul>
                <li><a href="#./inc/educacao.html" data-transition="pop"><img  src="assets/images/educacao.png"/><br>Educaçao</a></li>
                <li><a href="#./inc/esportes.html" data-transition="pop"><img  src="assets/images/esportes.png"/><br>Esportes</a></li>
                <li><a href="#./inc/alimentacao.html" data-transition="pop"><img  src="assets/images/alimentacao.png"/><br>Alimentação</a></li>
                <li><a href="#./inc/imoveis.html" data-transition="pop"><img  src="assets/images/imoveis.png"/><br>Imóveis</a></li>
            </ul>
        </div>
    </div>
</div>
<div  class="barra_up">
    <img src="./assets/images/Cinza_claro12.svg" style="width: 100%"/>
</div>
<div class="landindPage_who">
    <div id="newsletterform" class="noSpace" >
        <center>
            <img src="./assets/images/share.png"/>
        </center>
        <h1  class="whiteOne" style="text-align:center">
            COMPARTILHE
        </h1>
        <div class="columnsContainer">

            <div class="leftColumn" >
                <img src="./assets/images/Empresas.png"/>
                <div>
                    <h2  class="whiteOne">Empresas</h2>
                    <p  class="whiteOne">Quer promover seus produtos e serviços de forma geolocalizada? E se você pudesse saber mais sobre os consumidores (turistas e cidadãos) que estão próximos ao seu estabelecimento? E se você pudesse se comunicar com esse público?</p>
                </div>
            </div>

            <div class="rightColumn" >
                <img src="./assets/images/Pessoas.png"/>
                <div>
                    <h2 class="whiteOne">Pessoas</h2>
                    <p class="whiteOne" >Ja precisou de um borracheiro no domingo ou feriado? Fique por dentro dos seus pontos de interesse na cidade. Receba novidades dos estabelecimentos de sua preferência e receba promoções quando você estiver por perto.</p>
                </div>
            </div>
        </div>
        <div id="response"></div>
    </div>
</div>
<div  class="barra_up">
    <img src="./assets/images/Cinza_claro11.svg" style="width: 100%"/>
</div>
<div class="landindPage_carac" >
    <center>
        <img src="./assets/images/community.png"/>
        <h1>
            NOSSA COMUNIDADE
        </h1>
        <div style="margin-bottom: 100px">
            <h2 >Conheça quem já participa da nossa comunidade</h2>
            <div id="newsletterform" class="noSpace" >
                <?php
                $usersa = ProfileManager::getUsers();
                $users = $usersa->result;
                $total = 1;
                $tamanho = count($users);
                $keys = array();
                for ($i = 0; $i < 14;) {
                    $pos = rand(0, $tamanho);
                    if (isset($keys[$post])) {
                        continue;
                    }
                    $objeto = $users[$pos];
                    $keys[$pos] = $pos;
                    $i++;
                    $token = str_replace("[", "", $objeto->image);
                    $token = str_replace("]", "", $token);
                    $token = str_replace('"', "", $token);
                    $nick = str_replace('@', "", $objeto->nick);
                    $nick = str_replace('.com', "", $nick);
                    $nick = str_replace(' ', "", $nick);
                    $nick = substr($nick, 0, 5);
                    //echo $objeto->image;
                    echo '<img src="https://gaeloginendpoint.appspot.com/infosegcontroller.exec?action=5&blob-key=' . $token . '" class="img-circle-avatar" title="' . $nick . '@....."/>';
                }
                ?>
            </div>
        </div>
    </center>
    <div id="response"></div>
</div>
<div  class="barra_up">
    <img src="./assets/images/Cinza_claro12.svg" style="width: 100%"/>
</div>
<div class="landindPage_who">

    <center>
        <img src="./assets/images/nuvem_branca.svg"/>
    </center>
    <h1  class="whiteOne" style="text-align:center">
        DADOS ABERTOS
    </h1>
    <h2 class="whiteOne" style="text-align:center">
        Conectamos dados abertos para criar experiências.
    </h2>
    <div class="newsletterform" align="center" style="margin-bottom: 30px">
        <a href="#popupWebhose" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-transition="pop">
            <img class="wrap" src="assets/images/Webhose-01.png" height="48" border="0">
        </a>
        <div data-role="popup" id="popupWebhose">
            <p>Webhose IO é um crawler fornece notícias e dados relevantes e o City watch geolocaliza para você!</p>
        </div>
        <a href="#popupOpenstreet" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-transition="pop">
            <img class="wrap" src="assets/images/Openstreet-01.png" height="48" border="0">
        </a>
        <div data-role="popup" id="popupOpenstreet">
            <p>Openstreetmap fornece dados complementares para as diversas categorias do APP</p>
        </div>
        <a href="#popupMaps" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-transition="pop">
            <img class="wrap" src="assets/images/Maps.svg" height="48" border="0">
        </a>
        <div data-role="popup" id="popupMaps">
            <p>Utilizamos a plataforma e todas as funcionalidades do Google Maps que você ja conhece</p>
        </div>
        <a href="#popupTwitter" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-transition="pop">
            <img class="wrap" src="assets/images/Twitter.svg" height="48" border="0">
        </a>
        <div data-role="popup" id="popupTwitter">
            <p>Estamos integrados com os twetts geolocalizados na região</p>
        </div>
        <a href="#popupGenimo" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-transition="pop">
            <img class="wrap" src="assets/images/Genimo.svg" height="48" border="0">
        </a>
        <div data-role="popup" id="popupGenimo">
            <p>Genimo é um sistema de gestão imobiliária oferecendo um imóvel perto de você</p>
        </div>
    </div>
    <div id="response"></div>

</div>

<div class="landindPage_lead1" >
    <img src="./assets/images/Cinza11_2.svg" style="width: 100%"/>
    <center>
        <img src="./assets/images/email2.png"/>
        <h1  class="whiteOne">
            FIQUE LIGADO
        </h1>
        <div style="margin-bottom: 100px">
            <h2 class="whiteOne">Receba boletins e promoções de nossa rede</h2>
            <script type="text/javascript" src="//inbound.citywatch.com.br/form/generate.js?id=1"></script>
        </div>
    </center>
    <div id="response"></div>
</div>

