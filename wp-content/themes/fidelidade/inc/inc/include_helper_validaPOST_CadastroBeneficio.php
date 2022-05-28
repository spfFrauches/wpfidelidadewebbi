<?php

function recebeDadosPostCadastroBeneficio() {
    
    if (trim($_POST['cnpjemp']) == '' || empty($_POST['cnpjemp'])):
        $prosseguir = "nao";
        $result = false;
        $MgsAlertaCpf = "Não foi possivel identificar a empresa...";
    endif; 

    if (trim($_POST['descricaobeneficio']) == '' || empty($_POST['descricaobeneficio'])):
        $prosseguir = "nao";
        $result = false;
        $MgsAlertaNomeCompleto = "O campo [Descrição Beneficio] não foi informado";
    endif; 

    if (trim($_POST['valorpontos']) == '' || empty($_POST['valorpontos'])):
        $prosseguir = "nao";
        $result = false;
        $MgsAlertaEmail = "O campo [Valor em Pontos] não foi informado";
    endif;

    if (trim($_POST['status']) == '' || empty($_POST['status'])):
        $prosseguir = "nao";
        $result = false;
        $MgsAlertaTelefone = "O campo [Status] não foi informado";
    endif;


    if (trim($_POST['obsadicional']) == '' || empty($_POST['obsadicional'])):
        $prosseguir = "nao";
        $result = false;
        $MgsAlertaSenha = "O campo [Observação Adicional] não foi informado";
    endif;

    if (isset($_POST) && $prosseguir != "nao" ):
        $insertBeneficio = cadastroNovoBeneficio();
        return $insertBeneficio;
    endif;
    
}


