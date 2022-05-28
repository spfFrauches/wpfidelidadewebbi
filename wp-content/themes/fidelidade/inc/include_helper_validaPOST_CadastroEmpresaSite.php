<?php

if (trim($_POST['cnpj']) == '' || empty($_POST['cnpj'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaCnpj = "O campo [CNPJ] não foi informado";
endif; 

if (trim($_POST['cnpj']) != '') :
    $buscarDuplicadoBancoDados = buscarEmpresa($_POST['cnpj']);
    if (!$buscarDuplicadoBancoDados) {
        $prosseguir = "sim";
    } else {
        $prosseguir = "nao";
        $MgsAlertaCnpj = "O [CNPJ] informado já existe em nossos cadastros...";
        $result = false;
    }                 
endif;

if (trim($_POST['razao_social']) == '' || empty($_POST['razao_social'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaRazaoSocial = "O campo [Razão Social] não foi informado";
endif; 

if (trim($_POST['nome_fantasia']) == '' || empty($_POST['nome_fantasia'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaFantasia = "O campo [Nome Fantasia] não foi informado";
endif; 

if (trim($_POST['email']) == '' || empty($_POST['email'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaEmail = "O campo [E-mail] não foi informado";
endif;

if (trim($_POST['email']) != '') :
    $buscarDuplicadoBancoDadosEmail = emailEmpresa($_POST['email']);
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

if (trim($_POST['passwd']) == '' || empty($_POST['passwd'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaSenha = "O campo [Senha] não foi informado";
endif;

if (trim($_POST['password_confirma']) == '' || empty($_POST['password_confirma'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaConfirmarSenha = "O campo [Confirmar Senha] não foi informado";
endif;

if (trim($_POST['cep']) == '' || empty($_POST['cep'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaCep = "O campo [CEP] não foi informado";
endif;

if (trim($_POST['cidade']) == '' || empty($_POST['cidade'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaCidade = "O campo [Cidade] não foi informado";
endif;

if (trim($_POST['uf']) == '' || empty($_POST['uf'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaUf = "O campo [UF - Estado] não foi informado";
endif;

if (trim($_POST['endereco']) == '' || empty($_POST['endereco'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaEndereco = "O campo [Endereco] não foi informado";
endif;

if (trim($_POST['bairro']) == '' || empty($_POST['bairro'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaBairro = "O campo [Bairro] não foi informado";
endif;

if (trim($_POST['bairro']) == '' || empty($_POST['bairro'])):
    $prosseguir = "nao";
    $result = false;
    $MgsAlertaBairro = "O campo [Bairro] não foi informado";
endif;

if (isset($_POST) && $prosseguir == "sim" ) {
        
    function sanitizeString($string) {
        // matriz de entrada
        $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );
        // matriz de saída
        $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-' );
        // devolver a string
        return str_replace($what, $by, $string);
    }

    $array_insert = [
        'razao_social' => $_POST['razao_social'],
        'nome_fantasia' => $_POST['nome_fantasia'],
        'cnpj' =>  $_POST['cnpj'],
        'email' =>  $_POST['email'],
        'slug_empresa' =>   $urlFantasia = strtolower (sanitizeString($_POST['nome_fantasia'])),
        'passwd' => $_POST['passwd'],
        'telefone' => $_POST['telefone'],
        'whatsapptelegram' => $_POST['whatsapp'],
        'facebook' => $_POST['facebook'],
        'instagram' => $_POST['instagram'],            
        'data_cadastro' => $_POST['data_cadastro'],
        'fl_situacao' => 0,
        'cep' => $_POST['cep'],
        'cidade' => $_POST['cidade'],
        'uf' => $_POST['uf'],
        'endereco' => $_POST['endereco'],
        'bairro' => $_POST['bairro'],
        'numero' => $_POST['numero'],
        'complemento' => $_POST['complemento']
    ];

    $result = insertDB($array_insert);

}

