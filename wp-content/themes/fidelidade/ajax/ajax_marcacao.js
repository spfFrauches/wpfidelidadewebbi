$('#load_form_marcacao').hide();
$('#confirma_marcacaoNaoExiste').hide();
$('#confirma_marcacao').hide();
$('#btnMarcar').hide();
$('#confirma_marcacaoConfere').hide();
$('#btcVoltarMarcacaoConfere').hide();
$('#btnMarcarConfere').hide();
$('#btcVoltarVazio').hide();
$('#confirma_marcacaoConfereSucesso').hide();
$('#btnNovaMarcacao').hide();
$('#tempoLimiteMarcacao').hide();


$('.dinheiro').mask('#.##0,00', {reverse: true});
document.getElementById('cpfHelp').style.color = "gray"; 


/* ----------------------------------------------------  */
/* 1 Tela/load da marcação - Ao clicar em continuar      */
/* ----------------------------------------------------  */

$( "#btcContinuarMarcacao" ).click(function() {
    
    if ($('#cpf_marcacao').val() == '') { 
        
        alert("O CPF deve ser preenhcido");
        
        document.getElementById('cpf_marcacao').style.border = "solid 1px #FF0000"; 
        document.getElementById("cpfHelp").innerHTML = "O CPF deve ser preenchido";
        document.getElementById('cpfHelp').style.color = "red"; 
        return false; 
        
    } else {
        $('.cpf_form_marcacao').hide();
        $('#load_form_marcacao').show(); 
        $('#btcContinuarMarcacao').hide();
        $('#btnMarcar').show();
        $('#tempoLimiteMarcacao').hide();
        setTimeout(function(){ 
            /* Analisar o CPF no banco e retorna json */
            verificaSeExisteCPF();
        },1000);
    }
    return false; 
});

/* ----------------------------------------------------  */
/* 2 Tela/load da marcação - Ao clicar em Marcar  */
/* ----------------------------------------------------  */

$( "#btnMarcar" ).click(function() {
    
    var marcar = '1';
    var dataCPF = sessionStorage.getItem('cpf');
    var valorMarcacao = document.getElementById('valorMarcacao').value;
    var tipoMarcacao = document.getElementById('tipoMarcacao').value;
    var obsadicional = document.getElementById('obsadicional').value;
    
    console.log(tipoMarcacao);
    console.log("Vamos ver observaçãoes");
    console.log(obsadicional);
       
    if (valorMarcacao == '') {
        alert("O valor da Marcação deve ser preenhcido");
        document.getElementById('valorMarcacao').style.border = "solid 1px #FF0000";
        return false; 
    } else {
        document.getElementById('valorMarcacao').style.border = "";
    }
    
    document.getElementById("selfie2").src = sessionStorage.getItem('src_selfie');
    
    var xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "../wp-content/themes/fidelidade/ajax/ajax_marcacao.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
    xmlhttp.send("marcar="+marcar+"&dataCPF="+dataCPF+"&valor="+valorMarcacao+"&tipoMarcacao="+tipoMarcacao+"&obsadicional="+obsadicional);
    
    xmlhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var objMarcacao  = JSON.parse(this.responseText);
            console.log(objMarcacao);
            
            sessionStorage.setItem('valorMarcacao', objMarcacao['valor']);
            sessionStorage.setItem('datahoraMarcacao', objMarcacao['datahora']);
            sessionStorage.setItem('cnpjMarcacao', objMarcacao['cnpj']);
            sessionStorage.setItem('tipoMarcacao', tipoMarcacao);
            sessionStorage.setItem('obsadicional', obsadicional);
            
            $('#btcVoltarMarcacao').hide();
            $('#btnMarcar').hide();
            $('#btcContinuarMarcacao').hide();           
            $('#confirma_marcacao').hide();        
            $('#btcVoltarMarcacaoConfere').show();
            $('#load_form_marcacao').show();
            $('#btnMarcarConfere').show(); 
            
            setTimeout(function(){   
                $('#confirma_marcacaoConfere').show();
                $('#load_form_marcacao').hide();
                document.getElementById("confirma_marcacaoNomeConfere").innerHTML  = sessionStorage.getItem('nome_completo');
                document.getElementById("confirma_marcacaoCPFConfere").innerHTML   =  sessionStorage.getItem('cpf');
                document.getElementById("confirma_marcacaoValorConfere").innerHTML = sessionStorage.getItem('valorMarcacao');
                
            },1000);          
        }; 
    }
     
    return false; 
    
});

$( "#btnMarcarConfere" ).click(function() {
    
    console.log("ultima etapa");
       
    var marcarConfere = '1';
    var valorMarcacao    = sessionStorage.getItem('valorMarcacao');
    var datahoraMarcacao = sessionStorage.getItem('datahoraMarcacao');
    var cnpjMarcacao =  sessionStorage.getItem('cnpjMarcacao');
    var cpfMarcacao = sessionStorage.getItem('cpf');
    var tipoMarcacao = sessionStorage.getItem('tipoMarcacao');
    var obsadicional = sessionStorage.getItem('obsadicional');
    
    console.log("marcarconfere = "+marcarConfere);
    
    var xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "../wp-content/themes/fidelidade/ajax/ajax_marcacao.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
    xmlhttp.send("marcarConfere="+marcarConfere+"&cpf="+cpfMarcacao+"&valor="+valorMarcacao+"&cnpj="+cnpjMarcacao+"&datahora="+datahoraMarcacao+"&valorMarcacao="+valorMarcacao+"&tipoMarcacao="+tipoMarcacao+"&obsadicional="+obsadicional);
    
    xmlhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) {
            
            console.log("retorno do PHP");
            console.log(this.responseText);
            
            $('#load_form_marcacao').show();
            
            document.getElementById("selfie2").src = sessionStorage.getItem('src_selfie');
            
            setTimeout(function(){   
                $('#confirma_marcacaoConfere').hide();
                $('#confirma_marcacaoConfereSucesso').show();
                $('#load_form_marcacao').hide();
                $('#btnsMarcarVoltar').hide();
                $('#btnNovaMarcacao').show();

            },1000);   
                    
        }; 
    }
    
});

$( "#btnNovaMarcacao" ).click(function() {

    sessionStorage.removeItem('cpf');
    sessionStorage.removeItem('cnpjMarcacao');
    sessionStorage.removeItem('datahoraMarcacao');
    sessionStorage.removeItem('valorMarcacao');
    sessionStorage.removeItem('src_selfie');
    document.location.reload(true);

});

$( "#btcVoltarMarcacao" ).click(function() {
  
    $('#load_form_marcacao').show();
    $('#confirma_marcacao').hide();
    $('#btcContinuarMarcacao').show();
    $('#btnMarcar').hide();
    $('#confirma_marcacaoNaoExiste').hide();
    $('#tempoLimiteMarcacao').hide();
    
    sessionStorage.removeItem('src_selfie'); 
    document.getElementById("selfie").src = 'http://restaurantemegachic.com/fidelidade/wp-content/themes/fidelidade/img/default-user-1.png';
    
    setTimeout(function(){         
        $('.cpf_form_marcacao').show();
        $('#load_form_marcacao').hide();
        $('#tempoLimiteMarcacao').hide();
    },1000);  
        
});

$( "#btcVoltarMarcacaoConfere" ).click(function() {
    
    $('#load_form_marcacao').show();
    $('#confirma_marcacaoConfere').hide();
    $('#btnMarcarConfere').hide();
    $('#btcVoltarMarcacaoConfere').hide();
    $('#tempoLimiteMarcacao').hide();

    
    sessionStorage.removeItem('valorMarcacao');
    sessionStorage.removeItem('datahoraMarcacao');
    sessionStorage.removeItem('cnpjMarcacao');
    sessionStorage.removeItem('tipoMarcacao');
    setTimeout(function(){                 
        $('#btnMarcar').show();
        $('#btcVoltarMarcacao').show();
        $('#confirma_marcacao').show();          
        $('#load_form_marcacao').hide();
        return false;
    },1000); 
      
           
});

function verificaSeExisteCPF() {
    
    var cpf = document.getElementById('cpf_marcacao').value;
    var xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "../wp-content/themes/fidelidade/ajax/ajax_marcacao.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
    xmlhttp.send("cpf="+cpf);
    
    xmlhttp.onreadystatechange = function() {
            
        if (this.readyState == 4 && this.status == 200) {
                       
            if (this.responseText == "false") {
                $('#confirma_marcacaoNaoExiste').show();
                $('#load_form_marcacao').hide();                
            } else {
                
                $('#load_form_marcacao').hide(); 
                $('#confirma_marcacao').show();
               
                var objVerificarCliente  = JSON.parse(this.responseText);
                //objVerificarCliente  = (this.responseText);

                if (objVerificarCliente == 'tempoLimiteMarcacao') {
                    $('#tempoLimiteMarcacao').show();
                    $('#confirma_marcacao').hide();
                }
                
                /* Armazenando os dados cadastrai do cliente */               
                console.log(objVerificarCliente);  
                console.log(objVerificarCliente[0]['nome_completo']);
                
                document.getElementById("confirma_marcacaoNome").innerHTML = objVerificarCliente[0]['nome_completo'];
                document.getElementById("confirma_marcacaoCPF").innerHTML = objVerificarCliente[0]['cpf'];
                
                if (objVerificarCliente[0]['src_selfie'] == null || objVerificarCliente[0]['src_selfie'] == ''){
                    document.getElementById("selfie").src = 'http://restaurantemegachic.com/fidelidade/wp-content/themes/fidelidade/img/default-user-1.png';
                    sessionStorage.setItem('src_selfie', 'http://restaurantemegachic.com/fidelidade/wp-content/themes/fidelidade/img/default-user-1.png');
                } else {
                    document.getElementById("selfie").src = objVerificarCliente[0]['src_selfie'];
                    sessionStorage.setItem('src_selfie', objVerificarCliente[0]['src_selfie']);
                }
                                               
                sessionStorage.setItem('cpf', objVerificarCliente[0]['cpf']);
                sessionStorage.setItem('data_nascimento', objVerificarCliente[0]['data_nascimento']);
                sessionStorage.setItem('nome_completo', objVerificarCliente[0]['nome_completo']);
                sessionStorage.setItem('email', objVerificarCliente[0]['email']);
                sessionStorage.setItem('fone', objVerificarCliente[0]['fone']);
                                                
            }
        };     
    }
}

function marcarCartaoCliente() {
    
    $('#load_form_marcacao').show(); 
    $('#confirma_marcacao').hide();
    
}

