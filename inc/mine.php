<link href="assets/css/style2.css" rel="stylesheet" />
<div class="landindPage_lead1">
    <img src="./assets/images/docs.svg" class="ico_landind"/>
    <h1 class="whiteOne tit_landind">Minhas experiências</h1>
    <h2 class="whiteOne subtit_landind">Seus pontos de interesse e experiências compartilhadas</h2>
</div>
<div  class="barra_up">
    <img src="./assets/images/Cinza11_1.svg" style="width: 100%"/>
</div>
<div class="landindPage_carac">
    <div id="newsletterform">
        <ul data-role="listview" data-inset="true">
            <?php
            $experiences = ProfileManager::gExperience($myKey = $_SESSION['profile']->key);
            //var_dump($experiences);
            $vet = $experiences->result;
            echo "<h2>Você tem ".count($vet). " experiências compartilhadas</h2>";
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

