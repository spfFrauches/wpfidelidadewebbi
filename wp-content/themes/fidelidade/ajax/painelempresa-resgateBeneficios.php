<?php

$request = (object) $_REQUEST;

if (!empty ($funcao = $request->funcao) ) :    
    $funcao();
else:
    exit();
endif;

function carregarDadosBeneficio()
{
    require '../../../../wp-load.php';
    global $wpdb;     
    include( get_template_directory() . '/models/model_clientes.php' );

    $cliente = listarClienteFidelidade($_POST['cpf']);
       
    include( get_template_directory() . '/inc/include_resgate_beneficio_painel_empresa.php' );
    
}

