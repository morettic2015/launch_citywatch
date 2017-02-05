/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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

var ctrErro = document.getElementById('ctrErro');
var msg = "";
var frm = document.frmAccount;
function submitForm() {
    msg = "";

    if (frm.rg.value == "") {
        msg += "Informe o seu RG<br>";
        $('#tabDados').addClass('ui-btn-active');
        $('#fragment-1').addClass('ui-btn-active');
    }
    if (frm.cell.value == "") {
        msg += "Informe o seu Celular<br>";
        $('#tabDados').addClass('ui-btn-active');
        $('#fragment-1').addClass('ui-btn-active');
    }
    if (frm.nasc.value == "") {
        msg += "Informe a sua data de nascimento<br>";
        $('#tabDados').addClass('ui-btn-active');
        $('#fragment-1').addClass('ui-btn-active');
    }
    if (frm.sexo.value == "") {
        msg += "Informe o seu gênero<br>";
        $('#tabDados').addClass('ui-btn-active');
        $('#fragment-1').addClass('ui-btn-active');
    }
    if (frm.cep.value == "") {
        msg += "Informe o seu CEP<br>";
        $('#tabEndereco').addClass('ui-btn-active');
        $('#fragment-1').addClass('ui-btn-active');
    }
    if (frm.rua.value == "") {
        msg += "Informe a sua rua<br>";
        $('#tabEndereco').addClass('ui-btn-active');
        $('#fragment-1').addClass('ui-btn-active');
    }
    if (frm.bairro.value == "") {
        msg += "Informe o seu bairro<br>";
        $('#tabEndereco').addClass('ui-btn-active');
        $('#fragment-1').addClass('ui-btn-active');
    }
    if (frm.cidade.value == "") {
        msg += "Informe a sua cidade<br>";
        $('#tabEndereco').addClass('ui-btn-active');
        $('#fragment-1').addClass('ui-btn-active');
    }
    if (frm.pais.value == "") {
        msg += "Informe o seu pais<br>";
        $('#tabEndereco').addClass('ui-btn-active');
        $('#fragment-1').addClass('ui-btn-active');
    }
    if (frm.complemento.value == "") {
        msg += "Informe o complemento de seu endereço<br>";
        $('#tabEndereco').addClass('ui-btn-active');
        $('#fragment-1').addClass('ui-btn-active');
    }
    if (msg == "") {
        frm.submit();
    } else {
        ctrErro.innerHTML = " <span class='closebtn' onclick='this.parentElement.style.display = \"none\";'>&times;</span>";
        ctrErro.innerHTML += msg;
        ctrErro.style.display = "block";
    }
    return false;
}