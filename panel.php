<div data-role="panel" id="myPanel">
    <center>
        <h1><img width="96" height="96" style="border-radius: 50%;" src="<?php ProfileManager::getAvatar(); ?>"/></h1>
        <h2><?php ProfileManager::getName(); ?></h2>
        <p><?php ProfileManager::getEmail(); ?></p>
        <center>
            <div data-role="collapsible" data-inset="false" data-iconpos="right" data-theme="d" data-content-theme="a">
                <h3>Opções</h3>
                <div data-role="collapsible-set" data-inset="false" data-iconpos="right" data-theme="d" data-content-theme="a">
                    <div data-role="collapsible" data-content-theme="b">
                        <h3>Experiências</h3>
                        <ul data-role="listview">
                            <li><a href="#">Pesquisar</a></li>
                            <li><a href="#">Adicionar</a></li>
                            <li><a href="#">Favoritos</a></li>
                            <li><a href="#">Top 50</a></li>
                            <li><a href="#">Recomendações</a></li>
                            <li><a href="#">Compartilhar</a></li>
                        </ul>
                    </div><!-- /collapsible -->

                    <div data-role="collapsible" data-content-theme="b">
                        <h3>Promoções</h3>
                        <ul data-role="listview">
                            <li><a href="#">Visualizar</a></li>
                            <li><a href="#">Enviar</a></li>
                            <li><a href="#">Leads</a></li>
                            <li><a href="#">Estatísticas</a></li>
                        </ul>
                    </div><!-- /collapsible -->

                    <div data-role="collapsible" data-content-theme="b">
                        <h3>Mensagens</h3>
                        <ul data-role="listview">
                            <li><a href="#">Caixa de entrada</a></li>
                            <li><a href="#">Contatos</a></li>
                        </ul>
                    </div><!-- /collapsible -->
                    <div data-role="collapsible" data-content-theme="b">
                        <h3>Minha conta</h3>
                        <ul data-role="listview">
                            <li><a href="#">Dados pessoais</a></li>
                            <li><a href="#">Configurações</a></li>
                            <li><a href="index.php?p=planos">Meu plano</a></li>
                        </ul>
                    </div><!-- /collapsible -->
                    <div data-role="collapsible" data-content-theme="b">
                        <h3>API</h3>
                        <ul data-role="listview">
                            <li><a href="#">Chave de acesso</a></li>
                            <li><a href="#">Permissões</a></li>
                        </ul>
                    </div><!-- /collapsible -->
                    <div data-role="collapsible" data-content-theme="b">
                        <h3>Download</h3>
                        <ul data-role="listview">
                            <li><a href="#">Android</a></li>
                        </ul>
                    </div><!-- /collapsible -->
                    <div data-role="collapsible" data-content-theme="b">
                        <h3>Ajuda</h3>
                        <ul data-role="listview">
                            <li><a href="#">Android</a></li>
                        </ul>
                    </div><!-- /collapsible -->
                </div><!-- /collapsible-set -->
            </div><!-- /collapsible -->
            </div>