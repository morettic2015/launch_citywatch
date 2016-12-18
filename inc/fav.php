
<div id="newsletterform">
    <h1 style="margin-top: 100px">
        Promoções
    </h1>
    <h3>Confira as novidades e promoções do canal</h3>
    <p>
        Utilize sua conta no Paypal para ativar o seu plano!
    </p>
    <pre>
        <?php
        $id = $_SESSION['profile']->key;
        $promos = ProfileManager::loadFavorite($id);
        //var_dump($promos);//die();
        foreach ($promos->myFav as $p1) {
            ?>
                <div class="ui-btn ui-corner-all ui-btn-c">

                    <div class="ui-grid-solo">
                        <div class="ui-block-a"><h2><?php echo $p1->tit; ?></h2></div>
                    </div>
                    <div class="ui-grid-solo">
                        <div class="ui-block-a"><?php echo $p1->desc; ?></div>
                    </div>


                    <div class="ui-grid-b ui-responsive">
                        <div class="ui-block-a">Author:<br><?php echo $p1->author; ?></div>
                        <div class="ui-block-b"></div>
                        <div class="ui-block-c">Data:<br><?php echo $p1->date; ?></div>
                    </div>

                    <div class="ui-grid-solo">


                    <?php
                    ProfileManager::getImageFromToken($p1->tipo);
                    //echo "&nbsp;";
                    ?>

                    </div>
                    <div class="ui-grid-a ui-responsive">
                        <div class="ui-block-a"><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-comment">Enviar mensagem</a></div>
                        <div class="ui-block-b"><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-cloud">Compartilhar</a></div>
                    </div>
                    <br>
                </div>
        <?php } ?>
</div>