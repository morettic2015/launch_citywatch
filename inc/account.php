
<div id="newsletterform">
    <h1 style="margin-top: 100px" class="ui-btn ui-icon-user ui-btn-icon-left">
        Conta
    </h1>
    <h3>Mantenha seus dados atualizados</h3>

    <form method="GET" action="./" data-ajax="false" style="margin-bottom: 150px">
        <div data-role="fieldcontain">
            <label for="checkbox-based-flipswitch">Desejo receber notificações:</label>
            <input type="checkbox" id="checkbox-based-flipswitch" data-role="flipswitch">
        </div>
        <div data-role="fieldcontain">
            <label for="cep">Cep:</label>
            <input type="text" name="cep" id="cep" value="" placeholder="88000000" data-mini="true" onblur="getData(this)">
        </div>
        <div data-role="fieldcontain">
            <label for="rua">Rua:</label>
            <input type="text" name="rua" id="rua" value="" placeholder="Avenida rubens de arruda ramos" data-mini="true">
        </div>
        <div data-role="fieldcontain">
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" value="" placeholder="Agronômica" data-mini="true">
        </div>
        <div data-role="fieldcontain">
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" id="cidade" value="" placeholder="Florianópolis" data-mini="true">
        </div>
        <div data-role="fieldcontain">
            <label for="pais">Pais:</label>
            <input type="text" name="pais" id="pais" value="" placeholder="Brasil" data-mini="true">
        </div>
        <div data-role="fieldcontain">
            <label for="complemento">Complemento:</label>
            <input type="text" name="complemento" id="complemento" value="" placeholder="Brasil" data-mini="true">
        </div>
        <div data-role="fieldcontain">
            <label for="identif">Nr.Documento:</label>
            <input type="text" name="identif" id="identif" value="" placeholder="xxx.yyy.iii-xx" data-mini="true">
        </div>
        <div data-role="fieldcontain">
            <label for="celular">Celular:</label>
            <input type="tel" name="celular" id="celular" value="" placeholder="+55 48 99999-9987" data-mini="true">
        </div>
        <div data-role="fieldcontain">
            <label for="nascimento">Nascimento:</label>
            <input type="date" data-role="date" name="nascimento" id="nascimento" value="" placeholder="11/01/79" data-mini="true">
        </div>
        <div data-role="fieldcontain">
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo"><option value="">Sexo</option>
                <option value="MALE" selected="selected">Masculino</option>
                <option value="FEMALE">Feminino</option>
                <option value="OTHER">Outros</option>
            </select>
        </div>
        <div class="ui-field-contain">
            <fieldset data-role="controlgroup">
                <legend>Categorias de preferência:</legend>
                <input type="checkbox" name="checkbox-1a" id="checkbox-1a" class="custom">
                <label for="checkbox-1a">Cheetos</label>

                <input type="checkbox" name="checkbox-2a" id="checkbox-2a" class="custom">
                <label for="checkbox-2a">Doritos</label>

                <input type="checkbox" name="checkbox-3a" id="checkbox-3a" class="custom">
                <label for="checkbox-3a">Fritos</label>

                <input type="checkbox" name="checkbox-4a" id="checkbox-4a" class="custom">
                <label for="checkbox-4a">Sun Chips</label>
            </fieldset>
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

            showData.text('Loading the JSON file.');
        }
    </script>
</div>