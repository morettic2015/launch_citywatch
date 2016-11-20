
<div id="newsletterform">
    <h1>
        Promoções
    </h1>
    <h3>Confira as novidades e promoções do canal</h3>
    <p>
        Utilize sua conta no Paypal para ativar o seu plano!
    </p>

    <?php
    $promos = ProfileManager::loadPromotions(null);
    //var_dump($promos);
    foreach ($promos->result as $p1) {
        ?>
        <div class="ui-btn ui-corner-all ui-btn-c">

            <div class="ui-grid-solo">
                <div class="ui-block-a"><h2><?php echo $p1->tit; ?></h2></div>
            </div>
            <div class="ui-grid-solo">
                <div class="ui-block-a"><?php echo $p1->msg; ?></div>
            </div>


            <div class="ui-grid-b ui-responsive">
                <div class="ui-block-a">Author:<br><?php echo $p1->author; ?></div>
                <div class="ui-block-b"></div>
                <div class="ui-block-c">Data:<br><?php echo $p1->data; ?></div>
            </div>

            <div class="ui-grid-solo">


                <?php
                $vet = $p1->canais;
                foreach ($vet as $c1) {
                    ProfileManager::getImageFromToken($c1);
                    echo "&nbsp;";
                }
                ?>

            </div>
            <div class="ui-grid-b ui-responsive">
                <div class="ui-block-a"><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-comment">Enviar mensagem</a></div>
                <div class="ui-block-b"><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-heart">Favoritos</a></div>
                <div class="ui-block-c"><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-cloud">Compartilhar</a></div>
            </div>
            <br>
        </div>
    <?php } ?>
</div>