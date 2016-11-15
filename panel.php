<div data-role="panel" id="myPanel">
    <center>
    <h1><img width="96" height="96" style="border-radius: 50%;" src="<?php ProfileManager::getAvatar(); ?>"/></h1>
    <h2><?php ProfileManager::getName(); ?></h2>
    <p><?php ProfileManager::getEmail(); ?></p>
    <center>
    <div data-role="collapsible" data-inset="false" data-iconpos="right" data-theme="d" data-content-theme="d">
        <h3>Opções</h3>
        <div data-role="collapsible-set" data-inset="false" data-iconpos="right" data-theme="d" data-content-theme="d">
            <div data-role="collapsible">
                <h3>Experiências</h3>
                <ul data-role="listview">
                    <li><a href="#">Pesquisar</a></li>
                    <li><a href="#">Adicionar</a></li>
                </ul>
            </div><!-- /collapsible -->

            <div data-role="collapsible">
                <h3>Promoções</h3>
                <ul data-role="listview">
                    <li><a href="#">Visualizar</a></li>
                    <li><a href="#">Enviar</a></li>
                    <li><a href="#">Leads</a></li>
                    <li><a href="#">Estatísticas</a></li>
                </ul>
            </div><!-- /collapsible -->
             <div data-role="collapsible">
                <h3>Favoritos</h3>
                <ul data-role="listview">
                    <li><a href="#">Meus favoritos</a></li>
                    <li><a href="#">Top 50 favoritos</a></li>
                    <li><a href="#">Recomendações</a></li>
                </ul>
            </div><!-- /collapsible -->
            <div data-role="collapsible">
                <h3>Mensagens</h3>
                <ul data-role="listview">
                    <li><a href="#">Caixa de entrada</a></li>
                    <li><a href="#">Contatos</a></li>
                </ul>
            </div><!-- /collapsible -->
            <div data-role="collapsible">
                <h3>Minha conta</h3>
                <ul data-role="listview">
                    <li><a href="#">Dados pessoais</a></li>
                    <li><a href="#">Configurações</a></li>
                    <li><a href="index.php?p=planos">Meu plano</a></li>
                </ul>
            </div><!-- /collapsible -->

        </div><!-- /collapsible-set -->
    </div><!-- /collapsible -->
</div>