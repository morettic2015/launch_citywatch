
<div id="newsletterform">
    <h1 style="margin-top: 100px">
        Fontes de dados
    </h1>
    <h3>Compartilhe suas fontes de dados geolocalizadas.É fácil. Siga os 7 passos:</h3>
    <p>
        1) Cadastre a URL do seu serviço de dados JSON; 2)Identifique os campos de seus dados na aba de metadados; 3)Classifique seus dados em categorias
        4) Selecione a localização das fontes de dados (opcional); 5) Testar; 6) Configure o compartilhamento; 7) Salve sua fonte de dados
    </p>
    <div data-role="tabs"  data-theme="g">
        <div data-role="navbar">
            <ul>
                <li><a href="#fragment-1" class="ui-btn-active ui-icon-comment">Fontes de dados</a></li>
                <li><a href="#fragment-2" class="ui-icon-comment">Metadados</a></li>
                <li><a href="#fragment-3" class="ui-icon-comment">Compartilhamento</a></li>

            </ul>
        </div>
        <div id="fragment-1"  data-theme="g">


            <form method="GET" action="./" data-ajax="false">
                <div data-role="fieldcontain">
                    <label for="checkbox-based-flipswitch">Ativo:</label>
                    <input type="checkbox" id="checkbox-based-flipswitch" data-role="flipswitch">
                </div>
                <div data-role="fieldcontain">
                    <label for="nmDatasource">Nome:</label>
                    <input type="text" name="nmDatasource" id="nmDatasource" value="" placeholder="ex: taxi" data-mini="true">
                </div>
                <div data-role="fieldcontain">
                    <label for="urlDatasource">Url da fonte de dados:</label>
                    <input type="text" name="urlDatasource" id="urlDatasource" value="" placeholder="ex: taxi" data-mini="true">
                </div>
                <div data-role="fieldcontain">
                    <label for="classificacao[]">Classifique suas fontes de dados</label>
                    <select name="classificacao[]" id="classificacao[]" data-native-menu="false" data-mini="true" multiple="multiple" size="4">
                        <option>Categorias</option>
                        <option value="SEGURANCA">Segurança</option>
                        <option value="SAUDE">Saúde</option>
                        <option value="TURISMO">Turismo</option>
                        <option value="TRANSPORTE">Transporte</option>
                        <option value="INFRAESTRUTURA">Infraestrutura</option>
                        <option value="MEIO_AMBIENTE">Meio Ambiente</option>
                        <option value="SHOP">Shopping</option>
                        <option value="CULTURA">Cultura</option>
                        <option value="BEER">Cervejas</option>
                        <option value="EDUCACAO">Educação</option>
                        <option value="ESPORTE">Esportes</option>
                        <option value="ALIMENTACAO">Alimentação</option>
                        <option value="IMOVEIS">Imoveis</option>
                    </select>
                </div>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true" align="right">
                    <input type="submit" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-check ui-btn-b" data-theme="g" value="Salvar">
                    <input type="reset" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-delete ui-btn-b" data-theme="d"value="Testar">
                    <input type="reset" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-delete ui-btn-b" data-theme="f" value="Excluir">
                    <input type="reset" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-delete ui-btn-b" data-theme="e" value="Cancelar">
                </div>

            </form>

        </div>
        <div id="fragment-2"  data-theme="f">
            <p>This is the content of the tab 'Two', with the id fragment-2.</p>
        </div>
        <div id="fragment-3"  data-theme="c">
            <p>This is the content of the tab 'Two', with the id fragment-2.</p>
        </div>
    </div>
</div>