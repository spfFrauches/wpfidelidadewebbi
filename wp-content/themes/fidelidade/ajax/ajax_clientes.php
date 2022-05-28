<?php

include '../../../../wp-load.php';
require '../functions/functions_cliente.php';
require '../models/model_clientes.php';

if (isset($_POST['cpf'])){
    $seExisteCpf = verificarSeExiste($_POST['cpf']);
    if ($seExisteCpf){
        echo "ja_existe";
    }      
}

if (isset($_POST['email'])){   
    $seExisteEmail = seExisteEmail($_POST['email']);
    if ($seExisteEmail){
        echo "ja_existe";
    }  
}

if (isset($_POST['telefone'])){   
    $seExisteTelefone = seExisteTelefone($_POST['telefone']);
    if ($seExisteTelefone){
        echo "ja_existe";
    }  
}

if (isset($_POST['finalizarCadastroCliente']) && $_POST['finalizarCadastroCliente'] ) {
    
    $arrayCliente = [
        'nome_completo' => $_POST['nome_completo'],
        'cpf' => $_POST['cpf_cliente'],
        'data_nascimento' =>  $_POST['data_nascimento'],
        'email' => $_POST['email'],
        'fone' => $_POST['telefone'],
        'senha' =>  $_POST['senha'],
        'termos_uso' => 'SIM'
    ];
    
    $seExiste = verificarSeExiste($_POST['cpf_cliente']);
    
    if ($seExiste) {
        echo "jaExiste";
    }
    else {
        $inserir = insertDBCliente($arrayCliente);
        if ($inserir) { echo "cadastrado"; }
        else  { echo "erroAoInserirBanco"; }
    }
    
}