<?php
$email = strtoupper(ProfileManager::getEmail1());
$profile = ProfileManager::iDoExist($email);
if (!empty($_POST)) {
    ProfileManager::updateConfig($_POST, $profile->key, $profile->types);
    $profile = ProfileManager::iDoExist($email);
}
$hashMap = array();
$conf = $profile->config;
if (!empty($profile->config)) {
    foreach ($conf as $post) {
        $hashMap[$post] = $post;
    }
}
?>
<div class="landindPage_tit">
    <img src="./assets/images/profile.svg" class="ico_landind"/>
    <h1 class="whiteOne tit_landind">Perfil</h1>
    <h2 class="whiteOne subtit_landind">Mantenha seus dados atualizados e configure suas preferências</h2>

</div>
<div  class="barra_up">
    <img src="./assets/images/Cinza11_1.svg" style="width: 100%"/>
</div>
<div class="landindPage_carac">

    <div id="newsletterform" data-theme="f">
        <div id="ctrErro" class="alertRed"></div>
        <div data-role="popup" id="chatWindow" data-position-to="window" data-transition="turn"><p>Seus dados foram atualizados com sucesso.</p></div>
        <form method="POST" name="frmAccount" id="frmAccount" action="index.php?p=account" data-ajax="false" style="margin-bottom: 150px">
            <?php
            /**
             * Sucess message
             */
            if (!empty($_POST)) {
                ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                    Seus dados foram atualizados com sucesso.
                </div>
                <?php
            }
            ?>
            <div data-role="tabs"  data-theme="b">
                <div data-role="navbar">
                    <ul>
                        <li><a href="#fragment-1" id="tabDados" data-icon="user" class="ui-btn-active ui-icon-comment" data-theme="c">Dados pessoais</a></li>
                        <li><a href="#fragment-2" id="tabEndereco" data-icon="navigation" class="ui-icon-comment" data-theme="d">Endereço</a></li>
                        <li><a href="#fragment-3" id="tabConfig" data-icon="tag" class="ui-icon-comment" data-theme="e">Preferências</a></li>

                    </ul>
                </div>
                <div id="fragment-1"  data-theme="d">

                    <input type="hidden" readonly="true" id="idProfile" value="<?php echo $profile->key; ?>">

                    <div data-role="fieldcontain">
                        <label for="checkbox-empresa">Sou uma empresa</label>
                        <input type="checkbox" id="checkbox-empresa" data-role="flipswitch" name="checkbox-empresa" <?php echo (!empty($hashMap['IS_A_BUSSINESS'])) ? "checked" : ""; ?>>
                    </div>
                    <div data-role="fieldcontain" >
                        <label for="rg">Nr.Documento:</label>
                        <input type="text" name="rg" id="rg"  placeholder="xxx.yyy.iii-xx" data-mini="true"  value="<?php echo $profile->cpfCnpj; ?>" >
                    </div>
                    <div data-role="fieldcontain">
                        <label for="cell">Celular:</label>
                        <input type="tel" name="cell" id="cell" placeholder="+55 48 99999-9987" data-mini="true" value="<?php echo $profile->cell; ?>">
                    </div>
                    <div data-role="fieldcontain">
                        <label for="nasc">Nascimento:</label>
                        <input type="text" name="nasc" id="nasc" value="<?php echo $profile->nasc; ?>" placeholder="11/01/79" data-mini="true">
                    </div>
                    <div data-role="fieldcontain">
                        <label for="sexo">Sexo:</label>
                        <select id="sexo" name="sexo"><option value="">Sexo</option>
                            <option value="MALE" <?php echo empty($hashMap["MALE"]) ? "" : 'selected'; ?>>Masculino</option>
                            <option value="FEMALE" <?php echo empty($hashMap["FEMALE"]) ? "" : 'selected'; ?>>Feminino</option>
                            <option value="OTHER" <?php echo empty($hashMap["OTHER"]) ? "" : 'selected'; ?>>Outros</option>
                        </select>
                    </div>


                </div>
                <div id="fragment-2"  data-theme="c">
                    <p>
                    <div data-role="fieldcontain">
                        <label for="cep">Cep:</label>
                        <input type="text" name="cep" id="cep"  placeholder="88000000" data-mini="true" value="<?php echo $profile->cep; ?>" onblur="getData(this)">
                    </div>
                    <div data-role="fieldcontain">
                        <label for="rua">Rua:</label>
                        <input type="text" name="rua" id="rua"placeholder="Avenida rubens de arruda ramos" data-mini="true" value="<?php echo $profile->rua; ?>">
                    </div>
                    <div data-role="fieldcontain">
                        <label for="bairro">Bairro:</label>
                        <input type="text" name="bairro" id="bairro" placeholder="Agronômica" data-mini="true" value="<?php echo $profile->bairro; ?>">
                    </div>
                    <div data-role="fieldcontain">
                        <label for="cidade">Cidade:</label>
                        <input type="text" name="cidade" id="cidade"  placeholder="Florianópolis" data-mini="true" value="<?php echo $profile->cidade; ?>">
                    </div>
                    <div data-role="fieldcontain">
                        <label for="pais">Pais:</label>
                        <input type="text" name="pais" id="pais"  placeholder="Brasil" data-mini="true" value="<?php echo $profile->pais; ?>">
                    </div>
                    <div data-role="fieldcontain">
                        <label for="complemento">Complemento:</label>
                        <input type="text" name="complemento" id="complemento" placeholder="Complemento" value="<?php echo $profile->complemento; ?>"  data-mini="true">
                    </div>
                    </p>
                </div>
                <div id="fragment-3"  data-theme="c">
                    <p>
                    <div data-role="fieldcontain">
                        <label for="checkbox-based-flipswitch">Desejo receber notificações:</label>
                        <input type="checkbox" id="checkbox-based-flipswitch" data-role="flipswitch" name="news_enabled" <?php echo $profile->push ? "checked" : ""; ?>>
                    </div>
                    <div class="ui-field-contain">
                        <fieldset data-role="controlgroup">

                            <legend>Categorias de preferência:</legend>
                            <select name="canais[]" id="canais[]" data-native-menu="false" data-mini="true" multiple="multiple" size="4">
                                <option>Categorias</option>
                                <?php
                                $vet = $profile->types;

                                foreach ($vet as $objeto) {
                                    $selected = isset($hashMap[$objeto]) ? "selected" : "";
                                    //unset()
                                    ?>
                                    <option <?php echo @$selected; ?> value="<?php echo @$objeto ?>"><?php echo @$objeto; ?></option>


                                    <?php
                                }
                                ?>
                            </select>
                        </fieldset>
                    </div>
                    </p>
                </div>
            </div>


            <div data-role="controlgroup" data-type="horizontal" data-mini="true" align="right">
                <a href="javascript:submitForm()" data-rel="popup" class="ui-shadow ui-btn ui-corner-all ui-btn-g" data-theme="g" >Salvar</a>
                <input type="reset" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-delete ui-btn-b" data-theme="f"  value="Cancelar">
            </div>
        </form>
        <script src="./assets/js/account.js"></script>
    </div>
</div>