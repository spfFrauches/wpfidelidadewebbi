<?php

function cadastroNovoBeneficio() {   
    global $wpdb;       
    if(!empty($_FILES['imgbeneficio'])):  
        
        $targetDir = "./wp-content/themes/fidelidade/uploadfidelidade/beneficios_imgs/";                 
        chmod ($targetDir, 0777);   
        /* Renomeando o arquivo com base na data e hora */
        $datahr = date("Y-m-d h:i:s");
        $datahr  = str_replace(" ", "", $datahr);
        $datahr  = str_replace("-", "", $datahr);
        $datahr  = str_replace(":", "", $datahr); 
        $extension = explode(".", $_FILES["imgbeneficio"]["name"]);
        $renomearArquivo = $datahr.".".$extension[1];     
        $dir = get_bloginfo('template_url')."/uploadfidelidade/beneficios_imgs/".basename($_FILES["imgbeneficio"].$renomearArquivo);
        $target_file = $targetDir . basename($_FILES["imgbeneficio"].$renomearArquivo);      
        /* Uma simples camada de proteção para envio de imagens...*/
        $filename = $_FILES['imgbeneficio']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);    
        $allowed =  array('gif','png' ,'jpg', 'jpeg');       
        if(!in_array($ext, $allowed) ) :          
        else:
            if (move_uploaded_file ($_FILES['imgbeneficio']['tmp_name'], $target_file)):
            else:
                $dir = '';
                $target_file = '';
            endif;          
        endif;             
    endif; 
    
    $qtdPontos  = str_replace('.', '', $_POST['valorpontos']);
    $qtdPontos  = str_replace(',', '.', $qtdPontos);
    
    $dadosInput = [
        'descricao' => $_POST['descricaobeneficio'],
        'qtdpontos' =>  $qtdPontos,
        'dtvalidade' => '0000-00-00 00:00',
        'dtcadastro' => date("Y-m-d H:i"),
        'dtvalidade' => $_POST['dtvalidade'],
        'cnpjemp' => $_POST['cnpjemp'], 
        'imgsrcbeneficio' =>  $dir,
        'imgpathbeneficio' => $target_file,
        'obsadicional' => $_POST['obsadicional'],
        'status' => $_POST['status'],
    ];     
    $resultado = $wpdb->insert( 'beneficios', $dadosInput, array('%s','%f', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s') ) ;   
    if ($resultado):
        return true;
    else:
        return false;
    endif;      
}

function listarBeneficiosPorEmpresa($cnpj) {
    $tabela = "beneficios";
    global $wpdb; 
    $resultado =  $wpdb->get_results( "SELECT * FROM $tabela WHERE cnpjemp = '$cnpj' " );
    return $resultado;
}

function listarBeneficiosPorEmpresaViaCliente($cnpj) {
    $tabela = "beneficios";
    global $wpdb; 
    $resultado =  $wpdb->get_results( "SELECT * FROM $tabela WHERE cnpjemp = '$cnpj' AND status = 'ativo' " );
    return $resultado;
}

function listarBeneficiosPorID($id) {
    $tabela = "beneficios";
    global $wpdb; 
    $resultado =  $wpdb->get_results( "SELECT * FROM $tabela WHERE id = '$id'" );
    return $resultado;   
}

function updateBeneficio($id) {
    $tabela = "beneficios";
    global $wpdb;
    $camposUpdade = [
        "qtdpontos"  => $_POST['valorpontos'],
        "dtvalidade" => $_POST['dtvalidade'],
        "status" => $_POST['status']
    ];
    $resultado = $wpdb->update("$tabela", $camposUpdade, array('id'=>$id));   
    return $resultado;
       
}

function updateBeneficio2($id, $vlrPontos, $status) {
    $tabela = "beneficios";
    global $wpdb;
    $camposUpdade = [
        "qtdpontos"  => $vlrPontos,
        "status" => $status
    ];
    $resultado = $wpdb->update("$tabela", $camposUpdade, array('id'=>$id));   
    return $resultado;
       
}

function brindeMenorPonto($cnpjemp) { 
   $tabela = "beneficios";
   global $wpdb; 
   $resultado =  $wpdb->get_results( "SELECT min(qtdpontos) pontosMinimos FROM $tabela WHERE cnpjemp = '$cnpjemp'" );
   return $resultado;
}
