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
        
    include( get_template_directory() . '/models/model_beneficio.php' );
    
    $beneficio = listarBeneficiosPorID($_POST['id']);       
    include( get_template_directory() . '/inc/include_pontosEbeneficios.php' );
    
}

