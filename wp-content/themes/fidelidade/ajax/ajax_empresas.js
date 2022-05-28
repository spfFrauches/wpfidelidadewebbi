/* ---------------------------------------------------------- */
/* Validação básica Front - End ao Clicar no botão para envar */
/* ---------------------------------------------------------- */

$( "#btnContinuar" ).click(function() {
    
    console.log('enviando formulário');
    
    var cnpjEmp = $("#cnpj").val();  
    if (cnpjEmp.trim() == '') {
        document.getElementById("cnpjHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoCnpjErro();
        $("#cnpj").focus();
        return false;
    }
    
    var razaoSocialEmp =  $("#razao_social").val();  
    if (razaoSocialEmp.trim() == '') {
        document.getElementById("razao_socialHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoRazaoSocialErro();
        $("#razao_social").focus();
        return false;
    }
    
    var nomeFantasiaEmp =  $("#nome_fantasia").val();  
    if (nomeFantasiaEmp.trim() == '') {
        document.getElementById("nome_fantasiaHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoNomeFantasiaErro();
        $("#nome_fantasia").focus();
        return false;
    }
    
    var emailEmp =  $("#email").val();  
    if (emailEmp.trim() == '') {
        document.getElementById("emailHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoEmailErro();
        $("#email").focus();
        return false;
    }
    
    var telefoneEmp = $("#telefone").val();  
    if (telefoneEmp.trim() == '') {
        document.getElementById("telefoneHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoTelefoneErro();
        $("#telefone").focus();
        return false;
    }
    
    var senhaEmp =  $("#password").val();  
    if (senhaEmp.trim() == '') {
        document.getElementById("passwordHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoSenhaErro();
        $("#password").focus();
        return false;
    }
    
    /*
    var senhaConfirmarEmp =  $("#password_confirma").val();  
    if (senhaConfirmarEmp.trim() == '') {
        document.getElementById("passwordConfirmarHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoSenhaErro();
        $("#password_confirma").focus();
        return false;
    }
    */
    
    var cepEmp =  $("#cep").val();  
    if (cepEmp.trim() == '') {
        document.getElementById("cepHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoCepErro();
        $("#cep").focus();
        return false;
    }
    
    var cidadeEmp =  $("#cidade").val();  
    if (cidadeEmp.trim() == '') {
        document.getElementById("cidadeHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoCidadeErro();
        $("#cidade").focus();
        return false;
    }
    
    var ufEmp = $("#uf").val();  
    if (ufEmp.trim() == '') {
        document.getElementById("ufHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoUFErro();
        $("#uf").focus();
        return false;
    }
    
    var enderecoEmp =  $("#endereco").val();  
    if (enderecoEmp.trim() == '') {
        document.getElementById("enderecoHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoEnderecoErro();
        $("#endereco").focus();
        return false;
    }
    
    var bairroEmp =  $("#bairro").val();  
    if (bairroEmp.trim() == '') {
        document.getElementById("bairroHelp").innerHTML = "Este campo deve ser preenchido";
        pintarCampoBairroErro();
        $("#bairro").focus();
        return false;
    }
    
    $(".btnContinuarCadastroEmpresa").click(function(){    
        $('#modalLoad').modal('show');
        setTimeout(function() {
            $('#modalLoad').modal('hide');
        }, 2000);
    });
    
    
});

/* ---------------------------------------------------------- */
/* Validação básica Front - Ajax vai no banco ver se existe   */
/* ---------------------------------------------------------- */

function verificaSeExisteCNPJ() {
    
    var cnpj = document.getElementById('cnpj').value;
    var xmlhttp = new XMLHttpRequest(); 
        
    xmlhttp.open("POST", "../wp-content/themes/fidelidade/ajax/ajax_empresas.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
    xmlhttp.send("cnpj="+cnpj);
    analisaTodosCamposCnpj();
    xmlhttp.onreadystatechange = function() {
            
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "inexistente") {
               analisaTodosCamposCnpj();
               pintarCampoCnpjNormal();
            } else {
                analisaTodosCamposCnpj();
                document.getElementById("cnpjHelp").innerHTML = "Já existe um cadastro com esse CNPJ";
                pintarCampoCnpjErro(); 
            }     
        }       
    };     
}

function verificaSeExisteEmail(){
    
    analisaEmail();
    
    var email = document.getElementById('email').value;
    var xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "../wp-content/themes/fidelidade/ajax/ajax_empresas.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
    xmlhttp.send("email="+email);
    
    xmlhttp.onreadystatechange = function() {
            
        if (this.readyState == 4 && this.status == 200) {
            
            if (this.responseText == "inexistente") {
                pintarCampoEmailNormal(); 
            } else {
                document.getElementById("emailHelp").innerHTML = "Já existe um cadastro com este e-mail";
                pintarCampoEmailErro();
            }     
        }       
    };        
}

function confirmarSenha() {
    
    var senha =  document.getElementById("password").value;
    var confirmar_senha = document.getElementById("password_confirma").value;
    
    if (senha !== confirmar_senha) {  
        document.getElementById("password").style.border = "solid 1px #FF0000"; 
        document.getElementById("password_confirma").style.border = "solid 1px #FF0000";
        var desativar = document.createAttribute("disabled");  
        document.getElementById("btnContinuar").setAttributeNode(desativar);     
        document.getElementById("label_senha").innerHTML = "Senha";
        document.getElementById("label_senha_confirma").innerHTML = "Confirmar Senha";
        document.getElementById("passwordHelp").innerHTML = "As senhas digitadas devem ser iguais para confirmação";
        document.getElementById("passwordConfirmarHelp").innerHTML = "As senhas digitadas devem ser iguais para confirmação";
        document.getElementById("label_senha").style.color = "red";
        document.getElementById("label_senha_confirma").style.color = "red";
        document.getElementById("passwordHelp").style.color = "red";
        document.getElementById("passwordConfirmarHelp").style.color = "red";
    } else {
        document.getElementById("btnContinuar").removeAttribute("disabled"); 
        document.getElementById("password").style.border = ""; 
        document.getElementById("password_confirma").style.border = "";
         document.getElementById("passwordHelp").innerHTML = "";
        document.getElementById("passwordConfirmarHelp").innerHTML = "";
        document.getElementById("label_senha").style.color = "black";
        document.getElementById("label_senha_confirma").style.color = "black";
    }   
}

/* ---------------------------------------------------------- */
/* Voltando os campos ao normal caso esteja ok                */
/* ---------------------------------------------------------- */

function analisaRazaoSocial() {
    var razaoSocialEmp =  $("#razao_social").val();
    if (razaoSocialEmp.trim() != '') {
        pintarCampoRazaoSocialNormal(); 
    }  
}

function analisaFantasia() {
    var nomeFantasiaEmp =  $("#nome_fantasia").val();  
    if (nomeFantasiaEmp.trim() != '') {
       pintarCampoNomeFantasiaNormal(); 
    }
}

function analisaEmail() {
    var emailEmp =  $("#email").val();  
    if (emailEmp.trim() != '') {
       pintarCampoEmailNormal();
    }
}

function analisaTelefone() {
    var telefoneEmp =  $("#telefone").val();  
    if (telefoneEmp.trim() != '') {
       pintarCampoTelefoneNormal();
    }
}

function analisaCep() {
    var cepEmp =  $("#cep").val();  
    if (cepEmp.trim() != '') {
       pintarCampoCepNormal();
    }
}
function analisaCidade() {
    var cidadeEmp =  $("#cidade").val();  
    if (cidadeEmp.trim() != '') {
      pintarCampoCidadeNormal()
    }
}

function analisaUF() {
    var ufEmp =  $("#uf").val();  
    if (ufEmp.trim() != '') {
      pintarCampoUFNormal();
    }
}

function analisaEndereco() {
    var enderecoEmp =  $("#endereco").val();  
    if (enderecoEmp.trim() != '') {
      pintarCampoEnderecoNormal();
    }
}

function analisaBairro() {
    var bairroEmp =  $("#bairro").val();  
    if (bairroEmp.trim() != '') {
      pintarCampoBairroNormal();
    }
}



/* ---------------------------------------------  */
/* Funções auxiliares do arquivo  */
/* ---------------------------------------------  */

function pintarCampoCnpjNormal() {
    document.getElementById("cnpj").style.border = ""; 
    document.getElementById("label_cnpj").style.color = "black"; 
    document.getElementById("label_cnpj").innerHTML = "CNPJ *";
    document.getElementById("cnpjHelp").innerHTML = "";               
    document.getElementById("btnContinuar").removeAttribute("disabled"); 
}
function pintarCampoCnpjErro() {
    document.getElementById("cnpj").style.border = "solid 1px #FF0000"; 
    document.getElementById("label_cnpj").innerHTML = "CNPJ *";
    document.getElementById("label_cnpj").style.color = "red";
    document.getElementById("cnpjHelp").style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuar").setAttributeNode(desativar); 
}
function analisaTodosCamposCnpj() {
    if (document.getElementById('cnpj').value.length < 18) {
        document.getElementById("cnpjHelp").innerHTML = "Preencha todos os digitos do CNPJ";
        pintarCampoCnpjErro(); 
    }
}

function pintarCampoRazaoSocialErro() {    
    document.getElementById("razao_social").style.border = "solid 1px #FF0000"; 
    document.getElementById("label_razao_social").innerHTML = "Razão Social *";
    document.getElementById("label_razao_social").style.color = "red";
    document.getElementById("razao_socialHelp").style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuar").setAttributeNode(desativar); 
}
function pintarCampoRazaoSocialNormal() {    
    document.getElementById("razao_social").style.border = ""; 
    document.getElementById("label_razao_social").innerHTML = "Razão Social *";
    document.getElementById("label_razao_social").style.color = "black";
    document.getElementById("razao_socialHelp").style.color = "black";
    document.getElementById("razao_socialHelp").innerHTML = "";
    document.getElementById("btnContinuar").removeAttribute("disabled");
}

function pintarCampoNomeFantasiaErro() {    
    document.getElementById("nome_fantasia").style.border = "solid 1px #FF0000"; 
    document.getElementById("label_nome_fantasia").innerHTML = "Nome Fantasia *";
    document.getElementById("label_nome_fantasia").style.color = "red";
    document.getElementById("nome_fantasiaHelp").style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuar").setAttributeNode(desativar); 
}
function pintarCampoNomeFantasiaNormal() {    
    document.getElementById("nome_fantasia").style.border = ""; 
    document.getElementById("label_nome_fantasia").innerHTML = "Nome Fantasia *";
    document.getElementById("label_nome_fantasia").style.color = "black";
    document.getElementById("nome_fantasiaHelp").style.color = "black";
    document.getElementById("nome_fantasiaHelp").innerHTML = "";
    document.getElementById("btnContinuar").removeAttribute("disabled");   
}

function pintarCampoEmailErro(){
    document.getElementById("email").style.border = "solid 1px #FF0000"; 
    document.getElementById("label_email").innerHTML = "E-mail *";
    document.getElementById("label_email").style.color = "red";
    document.getElementById("emailHelp").style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuar").setAttributeNode(desativar);
}
function pintarCampoEmailNormal(){
    document.getElementById("email").style.border = ""; 
    document.getElementById("label_email").innerHTML = "E-mail *";
    document.getElementById("label_email").style.color = "black";
    document.getElementById("emailHelp").style.color = "black";
    document.getElementById("emailHelp").innerHTML = "";
    document.getElementById("btnContinuar").removeAttribute("disabled");
}

function pintarCampoTelefoneErro(){
    document.getElementById("telefone").style.border = "solid 1px #FF0000"; 
    document.getElementById("label_telefone").innerHTML = "Telefone *";
    document.getElementById("label_telefone").style.color = "red";
    document.getElementById("telefoneHelp").style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuar").setAttributeNode(desativar);    
}
function pintarCampoTelefoneNormal(){
    document.getElementById("telefone").style.border = ""; 
    document.getElementById("label_telefone").innerHTML = "Telefone *";
    document.getElementById("label_telefone").style.color = "black";
    document.getElementById("telefoneHelp").style.color = "black";
    document.getElementById("telefoneHelp").innerHTML = "";
    document.getElementById("btnContinuar").removeAttribute("disabled");
}

function pintarCampoSenhaErro(){
    document.getElementById("password").style.border = "solid 1px #FF0000"; 
    document.getElementById("label_senha").innerHTML = "Senha *";
    document.getElementById("label_senha").style.color = "red";
    document.getElementById("passwordHelp").style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuar").setAttributeNode(desativar);    
}

function pintarCampoCepErro(){
    document.getElementById("cep").style.border = "solid 1px #FF0000"; 
    document.getElementById("label_cep").innerHTML = "CEP *";
    document.getElementById("label_cep").style.color = "red";
    document.getElementById("cepHelp").style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuar").setAttributeNode(desativar);    
}
function pintarCampoCepNormal(){
    document.getElementById("cep").style.border = ""; 
    document.getElementById("label_cep").innerHTML = "";
    document.getElementById("label_cep").style.color = "black";
    document.getElementById("cepHelp").style.color = "black";
   document.getElementById("btnContinuar").removeAttribute("disabled");  
}

function pintarCampoCidadeErro(){
    document.getElementById("cidade").style.border = "solid 1px #FF0000"; 
    document.getElementById("label_cidade").innerHTML = "Cidade *";
    document.getElementById("label_cidade").style.color = "red";
    document.getElementById("cidadeHelp").style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuar").setAttributeNode(desativar);    
}
function pintarCampoCidadeNormal(){
    document.getElementById("cidade").style.border = ""; 
    document.getElementById("label_cidade").innerHTML = "Cidade *";
    document.getElementById("label_cidade").style.color = "black";
    document.getElementById("cidadeHelp").style.color = "black";
    document.getElementById("btnContinuar").removeAttribute("disabled");
}

function pintarCampoUFErro(){
    document.getElementById("uf").style.border = "solid 1px #FF0000"; 
    document.getElementById("label_uf").innerHTML = "UF *";
    document.getElementById("label_uf").style.color = "red";
    document.getElementById("ufHelp").style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuar").setAttributeNode(desativar);    
}
function pintarCampoUFNormal(){
    document.getElementById("uf").style.border = ""; 
    document.getElementById("label_uf").innerHTML = "UF *";
    document.getElementById("label_uf").style.color = "black";
    document.getElementById("ufHelp").style.color = "black";
    document.getElementById("btnContinuar").removeAttribute("disabled"); 
}

function pintarCampoEnderecoErro(){
    document.getElementById("endereco").style.border = "solid 1px #FF0000"; 
    document.getElementById("label_endereco").innerHTML = "Endereço *";
    document.getElementById("label_endereco").style.color = "red";
    document.getElementById("enderecoHelp").style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuar").setAttributeNode(desativar);    
}
function pintarCampoEnderecoNormal(){
    document.getElementById("endereco").style.border = ""; 
    document.getElementById("label_endereco").innerHTML = "Endereço *";
    document.getElementById("label_endereco").style.color = "black";
    document.getElementById("enderecoHelp").style.color = "black";
     document.getElementById("btnContinuar").removeAttribute("disabled"); 
}

function pintarCampoBairroErro(){
    document.getElementById("bairro").style.border = "solid 1px #FF0000"; 
    document.getElementById("label_bairro").innerHTML = "Bairro *";
    document.getElementById("label_bairro").style.color = "red";
    document.getElementById("bairroHelp").style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuar").setAttributeNode(desativar);    
}
function pintarCampoBairroNormal(){
    document.getElementById("bairro").style.border = ""; 
    document.getElementById("label_bairro").innerHTML = "Bairro *";
    document.getElementById("label_bairro").style.color = "black";
    document.getElementById("bairroHelp").style.color = "black";
    document.getElementById("btnContinuar").removeAttribute("disabled");        
}