<?php

$request = (object) $_REQUEST;

if (!empty ($funcao = $request->funcao) ) :    
    $funcao();
else:
    exit();
endif;

function carregarDadosCliente()
{
    require '../../../../wp-load.php';
    include( get_template_directory() . '/functions/functions_global.php' );
    global $wpdb; 
    
    $tabelaClientes = 'clientes';
    $tabelaMarcacoes = 'marcacao';
    $empresa_config = 'empresa_config';

    $cpf = $_REQUEST['cpfcliente'];
    $cnpj = $_REQUEST['cnpjempresa'];

    $sqlConfigEmpresa = "SELECT  * FROM $empresa_config  WHERE cnpjemp = '$cnpj' ";
    
    $sqlClientes = "SELECT * FROM $tabelaClientes WHERE cpf = '$cpf' ";

    $sqlMarcacoes = "SELECT * FROM $tabelaMarcacoes WHERE cnpjemp = '$cnpj' AND cpfcli = '$cpf' order by datamarcacao desc";
       
    $resultadoCadastroCliente =  $wpdb->get_results( $sqlClientes );
    $resutadoMarcacoes = $wpdb->get_results( $sqlMarcacoes );
    $resutadoConfiguracaoEmpresa = $wpdb->get_results( $sqlConfigEmpresa );
    
    /*
    echo "<pre>";
    var_dump($resutadoMarcacoes);
    echo "</pre>";
    */
    
    $totalPontos = 0;
    $totalPontosExpirados = 0;
    $totalPontosEstornados = 0;
    $totalPontosRetirada = 0;
       
    /* --------------------------------------------------------------------  */
    /* Varre as marcações para identificar qual fez parte do somatorios /*
    /* De pontos nos restages */
    /* --------------------------------------------------------------------  */
    foreach ($resutadoMarcacoes as $key1 => $value1) :
        if ($value1->tipomarcacao == 'retirada'):
            $dataRetirada = $value1->datamarcacao;
        endif;
        if ($value1->tipomarcacao != 'retirada'):            
            if ($value1->data_expiracao < date("Y-m-d")):                
                if (strtotime($dataRetirada) >= strtotime($value1->datamarcacao)):
                    $pontosUsados = 'sim';
                    $resultado = $wpdb->update('marcacao', 
                    array('data_expiracao'=>'2099-12-31'), 
                    array('id'=>$value1->id));
                else:
                    $pontosUsados = 'não';
                endif;
            endif;           
        endif;          
    endforeach;  
    
    /* --------------------------------------------------------------------  */
    /* --------------------------------------------------------------------  */
    
    $resutadoMarcacoes = $wpdb->get_results( $sqlMarcacoes );
    
    foreach ($resutadoMarcacoes as $key => $value) :        
        if ( $value->data_expiracao >= date("Y-m-d")  || $value->data_expiracao == null  ):  
            $totalPontos = $totalPontos + $value->pontos;  
        endif;   
    endforeach;
    
    foreach ($resutadoMarcacoes as $key => $value1) :        
        if ( $value1->estorno == 's' ):  
            $totalPontosEstornados = $totalPontosEstornados + $value1->pontos;  
        endif;   
    endforeach;
    
    $totalPontosEstornados = $totalPontosEstornados * ($resutadoConfiguracaoEmpresa[0]->vlrSimuladorMoedaApp);
        
    $totalPontos = $totalPontos * ($resutadoConfiguracaoEmpresa[0]->vlrSimuladorMoedaApp);
    $totalPontos = $totalPontos - $totalPontosEstornados;
   
    require ('../../../../wp-content/themes/fidelidade/inc/include_modalPainelEmpresa_meusClientes.php');
 
}

