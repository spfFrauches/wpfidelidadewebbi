$('#load_form_cadastroCliente').hide();
$('#load_form_cadastroCliente_finalizar').hide();
$('#success-icon').hide();
$('#error-icon').hide();

var cpf = document.getElementById('cpf');
var cpfLabel = document.getElementById('cpf_label');
var cpfHelp = document.getElementById('cpfHelp');

var nomeCompleto = document.getElementById('nomeCompleto');
var nomeLabel = document.getElementById('nome_label');
var nomeHelp = document.getElementById('nomeCompletoHelp');

var email = document.getElementById('email');
var emailLabel = document.getElementById('email_label');
var emailHelp = document.getElementById('emailHelp');

var dataNascimento = document.getElementById('data_nascimento');
var dataNascimentoLabel = document.getElementById('nascimento_label');
var dataNascimentoHelp = document.getElementById('nascimentoHelp');

var telefone = document.getElementById('telefone');
var telefoneLabel = document.getElementById('telefone_label');
var telefoneHelp = document.getElementById('telefoneHelp');

var sexo = document.getElementById('sexo');
var sexoLabel = document.getElementById('sexo_label');
var sexoHelp = document.getElementById('sexoHelp');

var senha =  document.getElementById("senha_cliente");
var senhaClienteLabel =  document.getElementById("senhaCliente");
var senhaHelp =  document.getElementById("senhaHelp");

var confirmar_senha = document.getElementById("senha_cliente_confirma");
var senhaClienteConfirmarLabel = document.getElementById("senhaClienteConfirmar");
var senhaConfirmaHelp = document.getElementById("senhaConfirmaHelp");

/* ----------------------------------------------------  */
/* Validando campos em branco / não preenchidos ...      */
/* ----------------------------------------------------  */

$( "#btnContinuarCadastroCliente" ).click(function() {
    
    var cpfCliente = $("#cpf").val();  
    if (cpfCliente.trim() == '') {      
        cpfHelp.innerHTML = "Este campo deve ser preenchido";
        pintarCampoCPFErro();
        $("#cpf").focus();
        return false;
    }
    
    var nomeCompletoCliente = $("#nomeCompleto").val();  
    if (nomeCompletoCliente.trim() == '') {
        nomeHelp.innerHTML = "Este campo deve ser preenchido";
        pintarCampoNomeErro();
        $("#nomeCompleto").focus();
        return false;
    }
    
    var emailCliente = $("#email").val();  
    if (emailCliente.trim() == '') {
        emailHelp.innerHTML = "Este campo deve ser preenchido";
        pintarCampoEmailErro();
        $("#email").focus();
        return false;
    }
    
    var nascimentoCliente = $("#data_nascimento").val();      
    if (nascimentoCliente.trim() == '') {
        dataNascimentoHelp.innerHTML = "Este campo deve ser preenchido";
        pintarCampoNascimentoErro();
        $("#data_nascimento").focus();
        return false;
    }
    
    var telefoneCliente = $("#telefone").val();  
    if (telefoneCliente.trim() == '') {
        telefoneHelp.innerHTML = "Este campo deve ser preenchido";
        pintarCampoTelefoneErro();
        $("#telefone").focus();
        return false;
    }
    
    var sexoCliente = $("#sexo").val();  
    if (sexoCliente.trim() == '') {
        sexoHelp.innerHTML = "Este campo deve ser preenchido";
        pintarCampoSexoErro();
        $("#sexo").focus();
        return false;
    }
    
    var senhaCliente = $("#senha_cliente").val();  
    if (senhaCliente.trim() == '') {
        senhaHelp.innerHTML = "Este campo deve ser preenchido";
        pintarCampoSenhaErro();
        $("#senha_cliente").focus();
        return false;
    }
    
    var senhaConfirmaCliente = $("#senha_cliente_confirma").val();  
    if (senhaConfirmaCliente.trim() == '') {
        senhaConfirmaHelp.innerHTML = "Este campo deve ser preenchido";
        pintarCampoSexoErro();
        $("#senha_cliente_confirma").focus();
        return false;
    }
    
    $('#modalLoad').modal('show');

            
});


/* ----------------------------------------------------  */
/* Buscando no banco campos duplicados ...               */
/* ----------------------------------------------------  */

cpf.addEventListener("blur", function() {
    var xmlhttp = new XMLHttpRequest();   
    xmlhttp.open("POST", "../wp-content/themes/fidelidade/ajax/ajax_clientes.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
    xmlhttp.send("cpf="+cpf.value);
    xmlhttp.onreadystatechange = function() {           
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "ja_existe") { 
                cpfHelp.innerHTML = "Já existe um cadastro com esse CPF";
                pintarCampoCPFErro();
            } else {
                 pintarCampoCPFNormal(); 
            }     
        }       
    };   
}, true);

email.addEventListener("blur", function() {    
    var emailCliente = $("#email").val();  
    if (emailCliente.trim() != '') {
        pintarCampoEmailNormal();
    }  
    var xmlhttp = new XMLHttpRequest();   
    xmlhttp.open("POST", "../wp-content/themes/fidelidade/ajax/ajax_clientes.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
    xmlhttp.send("email="+email.value);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "ja_existe") {
                pintarCampoEmailErro();
                emailHelp.innerHTML = "Já existe um cadastro com esse e-mail";
            } else {
                pintarCampoEmailNormal(); 
            }     
        }       
    };
}, true);

telefone.addEventListener("blur", function() {  
    var xmlhttp = new XMLHttpRequest();   
    xmlhttp.open("POST", "../wp-content/themes/fidelidade/ajax/ajax_clientes.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
    xmlhttp.send("telefone="+telefone.value);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "ja_existe") {
                pintarCampoTelefoneErro();
                telefoneHelp.innerHTML = "Já existe um cadastro com esse telefone.";
            } else {
                pintarCampoTelefoneNormal();
            }     
        }       
    };
}, true);


confirmar_senha.addEventListener("blur", function() {
    
    if (senha.value !== confirmar_senha.value) {         
        pintarCampoSenhaErro();
        pintarCampoSenhaConfirmarErro();       
        senhaHelp.innerHTML = "As senhas digitadas não são iguais";
        senhaConfirmaHelp.innerHTML = "As senhas digitadas não são iguais";
       
    } else {
        
        pintarCampoSenhaNormal();
        pintarCampoSenhaConfirmarNormal();  
               
    }  
    
}, true);


/* ---------------------------------------------  */
/* Voltar os campos ao normal caso preenchido     */
/* ---------------------------------------------  */
function analisarCpf() {
    var cpfCliente =  $("#cpf").val();
    if (cpfCliente.trim() != '') {
        pintarCampoCPFNormal();
    }  
}

function analisarNomeCompleto() {
    var nomeCompletoCliente = $("#nomeCompleto").val();  
    if (nomeCompletoCliente.trim() != '') {
        pintarCampoNomeNormal();
    }  
}

function analisarDataNascimento() {
    var dataNascimentoCliente = $("#data_nascimento").val();  
    if (dataNascimentoCliente.trim() != '') {
        pintarCampoNascimentoNormal();
    }  
}

function analisarTelefone() {
    var telefoneCliente = $("#telefone").val();  
    if (telefoneCliente.trim() != '') {
        pintarCampoTelefoneNormal();
    }  
}

function analisarSexo() {
    var sexoCliente = $("#sexo").val();  
    if (sexoCliente.trim() != '') {
        pintarCampoSexoNormal();
    }  
}

function analisarSenha() {
    var senhaCliente = $("#senha_cliente").val();  
    if (senhaCliente.trim() != '') {
        pintarCampoSenhaNormal();
    }  
}

/* ---------------------------------------------  */
/* Funções auxiliares do arquivo  */
/* ---------------------------------------------  */

function pintarCampoCPFErro() {
    cpf.style.border = "solid 1px #FF0000"; 
    cpfLabel.innerHTML = "CPF *";
    cpfLabel.style.color = "red";
    cpfHelp.style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuarCadastroCliente").setAttributeNode(desativar);    
}
function pintarCampoCPFNormal() {
    cpf.style.border = ""; 
    cpfLabel.innerHTML = "CPF *";
    cpfLabel.style.color = "black";
    cpfHelp.style.color = "black";
    cpfHelp.innerHTML = "";
    document.getElementById("btnContinuarCadastroCliente").removeAttribute("disabled");   
}

function pintarCampoNomeErro() {
    nomeCompleto.style.border = "solid 1px #FF0000"; 
    nomeLabel.innerHTML = "Nome completo *";
    nomeLabel.style.color = "red";
    nomeHelp.style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuarCadastroCliente").setAttributeNode(desativar);    
}
function pintarCampoNomeNormal() {
    nomeCompleto.style.border = ""; 
    nomeLabel.innerHTML = "Nome completo *";
    nomeLabel.style.color = "black";
    nomeHelp.style.color = "black";
    nomeHelp.innerHTML = "";
    document.getElementById("btnContinuarCadastroCliente").removeAttribute("disabled");   
}

function pintarCampoEmailErro() {
    email.style.border = "solid 1px #FF0000"; 
    emailLabel.innerHTML = "E-mail *";
    emailLabel.style.color = "red";
    emailHelp.style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuarCadastroCliente").setAttributeNode(desativar);    
}
function pintarCampoEmailNormal() {
    email.style.border = ""; 
    emailLabel.innerHTML = "E-mail *";
    emailLabel.style.color = "black";
    emailHelp.style.color = "black";
    emailHelp.innerHTML = "";
    document.getElementById("btnContinuarCadastroCliente").removeAttribute("disabled");     
}

function pintarCampoTelefoneErro() {
    telefone.style.border = "solid 1px #FF0000"; 
    telefoneLabel.innerHTML = "Telefone *";
    telefoneLabel.style.color = "red";
    telefoneHelp.style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuarCadastroCliente").setAttributeNode(desativar);    
}
function pintarCampoTelefoneNormal() {
    telefone.style.border = ""; 
    telefoneLabel.innerHTML = "Telefone *";
    telefoneLabel.style.color = "black";
    telefoneHelp.style.color = "black";
    telefoneHelp.innerHTML = "";
    document.getElementById("btnContinuarCadastroCliente").removeAttribute("disabled");      
}

function pintarCampoNascimentoErro() {
    dataNascimento.style.border = "solid 1px #FF0000"; 
    dataNascimentoLabel.innerHTML = "Data Nascimento *";
    dataNascimentoLabel.style.color = "red";
    dataNascimentoHelp.style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuarCadastroCliente").setAttributeNode(desativar);    
}
function pintarCampoNascimentoNormal() {
    dataNascimento.style.border = ""; 
    dataNascimentoLabel.innerHTML = "Data Nascimento *";
    dataNascimentoLabel.style.color = "black";
    dataNascimentoHelp.style.color = "black";
    dataNascimentoHelp.innerHTML = "";
    document.getElementById("btnContinuarCadastroCliente").removeAttribute("disabled");     
}

function pintarCampoSexoErro() {
    sexo.style.border = "solid 1px #FF0000"; 
    sexoLabel.innerHTML = "Sexo *";
    sexoLabel.style.color = "red";
    sexoHelp.style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuarCadastroCliente").setAttributeNode(desativar);    
}
function pintarCampoSexoNormal() {
    sexo.style.border = ""; 
    sexoLabel.innerHTML = "Sexo *";
    sexoLabel.style.color = "black";
    sexoHelp.style.color = "black";
    sexoHelp.innerHTML = "";
    document.getElementById("btnContinuarCadastroCliente").removeAttribute("disabled");     
}

function pintarCampoSenhaErro() {
    senha.style.border = "solid 1px #FF0000"; 
    senhaClienteLabel.innerHTML = "Senha *";
    senhaClienteLabel.style.color = "red";
    senhaHelp.style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuarCadastroCliente").setAttributeNode(desativar);    
}
function pintarCampoSenhaNormal() {
    senha.style.border = ""; 
    senhaClienteLabel.innerHTML = "Senha *";
    senhaClienteLabel.style.color = "black";
    senhaHelp.style.color = "black";
    senhaHelp.innerHTML = "";
    document.getElementById("btnContinuarCadastroCliente").removeAttribute("disabled");       
}

function pintarCampoSenhaConfirmarErro() {
    confirmar_senha.style.border = "solid 1px #FF0000"; 
    senhaClienteConfirmarLabel.innerHTML = "Confirmar Senha *";
    senhaClienteConfirmarLabel.style.color = "red";
    senhaConfirmaHelp.style.color = "red";
    var desativar = document.createAttribute("disabled");  
    document.getElementById("btnContinuarCadastroCliente").setAttributeNode(desativar);    
}
function pintarCampoSenhaConfirmarNormal() {
    confirmar_senha.style.border = ""; 
    senhaClienteConfirmarLabel.innerHTML = "Confirmar Senha *";
    senhaClienteConfirmarLabel.style.color = "black";
    senhaConfirmaHelp.style.color = "black";
    senhaConfirmaHelp.innerHTML = "";   
    document.getElementById("btnContinuarCadastroCliente").removeAttribute("disabled");    
}