<?php

if (trim($_POST['cpf_cliente']) == '' || empty($_POST['cpf_cliente'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaCpf = "O campo [CPF] não foi informado";
endif; 

if (trim($_POST['cpf_cliente']) != '') :
    $buscarDuplicadoBancoDados = verificarSeExiste($_POST['cpf_cliente']);
    if (!$buscarDuplicadoBancoDados) {
        $prosseguir = "sim";
    } else {
        $prosseguir = "nao";
        $MgsAlertaCpf = "O [CPF] informado já existe em nossos cadastros...";
        $result = false;
    }                 
endif;

if (trim($_POST['nome_completo']) == '' || empty($_POST['nome_completo'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaNomeCompleto = "O campo [Nome completo] não foi informado";
endif; 

if (trim($_POST['email']) == '' || empty($_POST['email'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaEmail = "O campo [E-mail] não foi informado";
endif;

if (trim($_POST['email']) != '') :
    $buscarDuplicadoBancoDadosEmail = seExisteEmail($_POST['email']);
    if (!$buscarDuplicadoBancoDadosEmail) {
        $prosseguir = "sim";
    } else {
        $prosseguir = "nao";
        $MgsAlertaEmail = "O [E-mail] informado já existe em nossos cadastros...";
        $result = false;
    }                 
endif;

if (trim($_POST['telefone']) == '' || empty($_POST['telefone'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaTelefone = "O campo [Telefone] não foi informado";
endif;

if (trim($_POST['telefone'] != '')):
    
    $buscarFoneDuplicado = seExisteTelefone($_POST['telefone']);
    if (!$buscarFoneDuplicado) {
        $prosseguir = "sim";
    } else {
        $prosseguir = "nao";
        $MgsAlertaTelefone = "O [Telefone] informado já existe em nossos cadastros...";
        $result = false;
    }   
    
endif;

if (trim($_POST['senha']) == '' || empty($_POST['senha'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaSenha = "O campo [Senha] não foi informado";
endif;

if (trim($_POST['password_confirma']) == '' || empty($_POST['password_confirma'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaConfirmarSenha = "O campo [Confirmar Senha] não foi informado";
endif;


if (isset($_POST) && $prosseguir == "sim" ) {
          
    $insertCliente = cadastroClienteViaSite();
   
}

