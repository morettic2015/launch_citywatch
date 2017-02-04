<?php 
$email = strtoupper(ProfileManager::getEmail1());
//echo $email;
//var_dump($email);
$p1 = ProfileManager::iDoExist($email);
//$checked = empty(config['IS_A_BUSSINESS'])?"checked":"";
?>
<div data-role="panel" id="myPanel">
    <center>
        <h1><img width="96" height="96" style="border-radius: 50%;" src="<?php ProfileManager::getAvatar(); ?>"/></h1>
        <h2><?php ProfileManager::getName(); ?></h2>
        <p><?php ProfileManager::getEmail(); ?></p>
         <div data-role="fieldcontain">
             <label for="checkbox-alerta"><small>Alertas</small></label>
            <input type="checkbox" id="checkbox-alerta" data-role="flipswitch" data-mini="true" name="checkbox-alerta"  <?php echo $p1->push ? "checked" : ""; ?>>
        </div>

        <div data-role="collapsible" data-collapsed="false" data-inset="false" data-iconpos="left" data-theme="a" data-content-theme="a">
            <h3>Opções</h3>
            <div data-role="collapsible-set" data-inset="false" data-iconpos="left" data-theme="a" data-content-theme="a">
                <div data-role="collapsible" data-content-theme="b"  data-collapsed-icon="location">
                    <h3>Experiências</h3>
                    <ul data-role="listview" data-iconpos="left">
                        <li><a data-rel="popup" data-transition="slideup" href="#popupSrc">Pesquisar</a></li>
                        <li><a href="./?p=mine">Minhas experiências</a></li>
                        <li><a href="./?p=experience">Compartilhar experiência</a></li>
                        <!-- <li><a href="./?p=news">Na sua cidade</a></li> -->
                        <!--<li><a href="./?p=news">Novidades na sua área</a></li> -->
                        <!-- <li><a href="./?p=fav">Favoritos</a></li>
                         <li><a href="#">Top 50</a></li> --> 

                        <!--    <li><a href="#">Compartilhar</a></li> -->
                    </ul>
                </div><!-- /collapsible -->

                <!--   <div data-role="collapsible" data-content-theme="a"  data-collapsed-icon="star" data-iconpos="left">
                       <h3>Promoções</h3>
                       <ul data-role="listview" data-iconpos="left" data-theme="a">
                           <li><a href="index.php?p=promocoes">Visualizar</a></li>
                           <li><a href="#">Enviar</a></li>
                           <li><a href="#">Leads</a></li>
                           <li><a href="index.php?p=stats" data-ajax="false">Estatísticas</a></li>
                       </ul>
                   </div>--><!-- /collapsible -->

                <!--   <div data-role="collapsible" data-content-theme="b" data-collapsed-icon="mail" data-iconpos="left">
                       <h3>Mensagens</h3>
                       <ul data-role="listview" data-iconpos="left">
                           <li><a href="#">Caixa de entrada</a></li>
                           <li><a href="#">Contatos</a></li>
                       </ul>
                   </div>--><!-- /collapsible -->
                <div data-role="collapsible" data-content-theme="b"  data-collapsed-icon="user" data-iconpos="left">
                    <h3>Minha conta</h3>
                    <ul data-role="listview" data-iconpos="left">
                        <!--  <li><a href="#">Dados pessoais</a></li> -->
                        <li><a data-ajax="false" href="index.php?p=account">Perfil</a></li>
                        <!--  <li><a href="index.php?p=planos">Plano</a></li> -->
                    </ul>
                </div><!-- /collapsible -->
                <!-- <div data-role="collapsible" data-content-theme="b"  data-collapsed-icon="gear" data-iconpos="left">
                     <h3>API</h3>
                     <ul data-role="listview" data-iconpos="left">
                         <li><a href="#">Chave de acesso</a></li>
                         <li><a href="#">Permissões</a></li>
                         <li><a href="index.php?p=datasource">Fonte de dados</a></li>
                     </ul>
                 </div>--><!-- /collapsible -->

                <div data-role="collapsible" data-content-theme="b"  data-collapsed-icon="alert" data-iconpos="left">
                    <h3>Ajuda</h3>
                    <ul data-role="listview" data-iconpos="left">
                        <li><a href="index.php?p=help">Ajuda</a></li>
                        <li><a  href="index.php?p=eula">Termo de uso</a></li>
                    </ul>
                </div><!-- /collapsible -->
                <div data-role="collapsible" data-content-theme="b"  data-collapsed-icon="power" data-iconpos="left"> 
                    <h3>Sair</h3>
                    <ul data-role="listview" data-iconpos="left">
                        <li><a href="index.php?p=logout">Fechar sessão</a></li>
                    </ul>
                </div><!-- /collapsible -->
            </div><!-- /collapsible-set -->
        </div><!-- /collapsible -->
      
</div>