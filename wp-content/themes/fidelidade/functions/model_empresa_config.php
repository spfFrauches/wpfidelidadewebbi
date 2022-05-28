<?php

function inserirConfiguracao ($arrayDados) {
    
    
    global $wpdb;     
    $tabela1 = "empresa_config";
        
    $dadosInsert = array(   'cnpjemp'           => $arrayDados['cnpjemp'], 
                            'tipo_marcacao'     => $arrayDados['tipo_marcacao'],
                            'percentual_vlrcompra' => $arrayDados['percentual'],
                            'dthr_ultima_alteracao' => $arrayDados['dthr_ultima_alteracao'],
                            'tempoExpirarPontos' => $arrayDados['tempoExpiracao'],
                            'tempo_expira_resgate' => $arrayDados['tempoExpiracaoResgate'],
                            'tempoEntreMarcacao' =>   $arrayDados['tempoEntreMarcacao']
                        );
      
    $dadosInsertDB   = $wpdb->insert( "$tabela1", $dadosInsert,  array('%s','%s','%f','%s','%d','%d', '%d' ) ) ; 
    
    
    if ($dadosInsertDB){
        return true;
    } else {
        return false;
    }
  
}

function verConfigMarcacaoEmpresa($cnpj) {
    
    global $wpdb; 
    $resultado =  $wpdb->get_results( "SELECT * FROM empresa_config where cnpjemp = '$cnpj' " );
    return $resultado;
    
}

function updateConfiguracaoEmpresa($dados){
    
    $percentual = $dados['percentual'];
    $cnpj = $dados['cnpjemp'];
    $tempoExpiracao = $dados['tempoExpiracao'];
    $tempoExpiracaoResgate = $dados['tempoExpiracaoResgate'];
    $tempoEntreMarcacao = $dados['tempoEntreMarcacao'];
    
    global $wpdb; 
    $resultado = $wpdb->update('empresa_config', 
            array('percentual_vlrcompra'=>$percentual, 'tempoExpirarPontos' => $tempoExpiracao, 'tempo_expira_resgate' => $tempoExpiracaoResgate, 'tempoEntreMarcacao' =>   $tempoEntreMarcacao ), 
            array('cnpjemp'=>$cnpj));
    return $resultado;
    
}