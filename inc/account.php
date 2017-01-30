<?php
//echo '<pre>';
$email = strtoupper(ProfileManager::getEmail1());
//echo $email;
//var_dump($email);
$profile = ProfileManager::iDoExist($email);
//var_dump($profile);
//var_dump($_SESSION);



if (!empty($_POST)) {
    ProfileManager::updateConfig($_POST, $profile->key, $profile->types);
    $profile = ProfileManager::iDoExist($email);
}
$hashMap = array();
//var_dump($profile->config);
$conf = $profile->config;
if (!empty($profile->config)) {

    foreach ($conf as $post) {
        $hashMap[$post] = $post;
    }
}
//var_dump($profile);
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

        <div data-role="popup" id="chatWindow" data-position-to="window" data-transition="turn"><p>Seus dados foram atualizados com sucesso.</p></div>
        <form method="POST" action="index.php?p=account" data-ajax="false" style="margin-bottom: 150px">
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
                        <li><a href="#fragment-1" data-icon="user" class="ui-btn-active ui-icon-comment">Dados pessoais</a></li>
                        <li><a href="#fragment-2" data-icon="navigation" class="ui-icon-comment">Endereço</a></li>
                        <li><a href="#fragment-3" data-icon="tag" class="ui-icon-comment">Preferências</a></li>

                    </ul>
                </div>
                <div id="fragment-1"  data-theme="d">

                    <input type="hidden" readonly="true" id="idProfile" value="<?php echo $profile->key; ?>">

                    <div data-role="fieldcontain">
                        <label for="checkbox-empresa">Sou uma empresa</label>
                        <input type="checkbox" id="checkbox-empresa" data-role="flipswitch" name="empresa" <?php echo $profile->push ? "checked" : ""; ?>>
                    </div>
                    <div data-role="fieldcontain">
                        <label for="rg">Nr.Documento:</label>
                        <input type="text" name="rg" id="rg"  placeholder="xxx.yyy.iii-xx" data-mini="true"  value="<?php echo $profile->cpfCnpj; ?>">
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
                <input type="submit" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-check ui-btn-a" data-theme="g" value="Salvar">
                <input type="reset" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-delete ui-btn-b" data-theme="f"  value="Cancelar">
            </div>
        </form>
        <script>
            function getData(elemento) {
                $.getJSON("./src/postalcode.php?code=" + elemento.value, function (data) {
                    console.log(data);
                    $('#cidade').val(data.city);
                    $('#pais').val(data.country);
                    $('#complemento').val(data.state);
                    $('#bairro').val(data.bairro);
                });

                //showData.text('Loading the JSON file.');
            }
            $("#bairro").attr('required', true);
            $("#cidade").attr('required', true);
            $("#cep").attr('required', true);
            $("#complemento").attr('required', true);
            $("#rua").attr('required', true);
            $("#pais").attr('required', true);
            $("#cell").attr('required', true);
            $("#rg").attr('required', true);
            $("#nasc").attr('required', true);
            $("#sexo").attr('required', true);
        </script>
    </div>
</div>