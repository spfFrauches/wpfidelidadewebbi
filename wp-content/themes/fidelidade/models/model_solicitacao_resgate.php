<?php

function inserirSolicitacao($post) 
{
    
    global $wpdb; 
    $cnpj = $post['cnpjemp'];
    
    date_default_timezone_set('America/Bahia');
    
    $sqlDataVencimentoResgate = "SELECT tempo_expira_resgate "
            . "FROM empresa_config "
            . "WHERE cnpjemp = '$cnpj'";
           
    $sqlDataVencimentoResgate =  $wpdb->get_results($sqlDataVencimentoResgate);
    $tempoExiraResgate = $sqlDataVencimentoResgate[0]->tempo_expira_resgate;
     
    $data = date("Y-m-d H:i");
    $moreDays = $tempoExiraResgate;
    
    if ( $tempoExiraResgate == '0'):
        $tempoExiraResgate  = '2199-12-31';
    else:
        $tempoExiraResgate  = date('Y-m-d', strtotime($data. " + $moreDays days"));
    endif;
    
    
     
    $dadosInput = [
        'cnpjemp' => $cnpj,
        'cpfcliente' =>  $post['cpfcliente'],
        'cdbeneficio' => $post['cdbeneficio'],
        'dtsolicitacao' =>  $data,
        'status' => $post['status'],
        'dtvencimento' => $tempoExiraResgate
    ];  
    
    $resultado = $wpdb->insert( 'solicitacao_resgate', 
                $dadosInput, 
                array('%s','%s', '%d', '%s', '%s', '%s') ) ; 
    
    if ($resultado):
        
        return true;
    else:
        return false;
    endif; 
       
}


function verificarDataVencimento($cnpj)
{
    global $wpdb; 
    $dthoje  = date("Y-m-d");
    
    $sql    = "SELECT * FROM solicitacao_resgate "
            . "WHERE status = 'solicitado' "
            . "AND dtvencimento <= '$dthoje' "
            . "AND cnpjemp = '$cnpj' ";
    
    $clienteResgateVencimento = $wpdb->get_results($sql);
    
    foreach ($clienteResgateVencimento as $key => $value) :
        
        $wpdb->update('solicitacao_resgate', 
            array(
                'status'=>'vencido',
            ), 
            array('idresgate'=>$value->idresgate ));
    endforeach;
      
    return $clienteResgateVencimento;
       
}

function listarSolicitacaoRestage($cpf) {
    
    // solicitacao_resgate    
    global $wpdb;
    
    $result1 = $wpdb->get_results("SELECT emp.razao_social,  "
            . "emp.nome_fantasia, ben.descricao, solRes.status,"
            . "solRes.dtsolicitacao, solRes.dtresgate,  solRes.dtvencimento "
            . "FROM solicitacao_resgate solRes "
            . "INNER JOIN beneficios ben ON solRes.cdbeneficio = ben.id  "
            . "INNER JOIN empresas emp ON solRes.cnpjemp = emp.cnpj "
            . "WHERE cpfcliente = '$cpf' order by solRes.idresgate desc");
    
    // $result  = $wpdb->get_results("SELECT * FROM solicitacao_resgate WHERE cpfcliente = '$cpf'  ORDER BY dtsolicitacao DESC ");
    return $result1;
          
}

function listarSolicitacaoRestageConfere($cpf, $cdbeneficio) {
    
    // solicitacao_resgate    
    global $wpdb;
 
    $result  = $wpdb->get_row("SELECT * FROM solicitacao_resgate "
            . "WHERE cpfcliente = '$cpf' AND cdbeneficio = '$cdbeneficio' "
            . "AND status = 'solicitado' "
            . "ORDER BY dtsolicitacao DESC ");
    return $result;
          
}

function listarSolicitacaoRestageConfere2($cpf, $cnpj) {
    
    // solicitacao_resgate    
    global $wpdb;
 
    $result  = $wpdb->get_row("SELECT * FROM solicitacao_resgate "
            . "WHERE cpfcliente = '$cpf' AND cnpjemp = '$cnpj' "
            . "AND status = 'solicitado' "
            . "ORDER BY dtsolicitacao DESC ");
    return $result;
          
}


function listarSolicitacaoRestageEmpresa($empresa) {
    
    // solicitacao_resgate    
    global $wpdb;
 
    $result  = $wpdb->get_results("SELECT solRes.idresgate, solRes.dtsolicitacao ,solRes.cnpjemp, ben.id as idbeneficio, "
            . "ben.descricao, solRes.status, ben.qtdpontos, solRes.dtvencimento , "
            . "solRes.cpfcliente, cli.nome_completo , cli.src_selfie "
            . "FROM solicitacao_resgate solRes "
            . "INNER JOIN beneficios ben ON solRes.cdbeneficio = ben.id "
            . "INNER JOIN empresas emp ON solRes.cnpjemp = emp.cnpj "
            . "INNER JOIN clientes cli ON solRes.cpfcliente = cli.cpf "
            . "WHERE solRes.cnpjemp = '$empresa'  "
            . "ORDER BY solRes.dtsolicitacao DESC");   
    return $result;
           
}

function listarSolicitacaoRestageEmpresaApenasSolicitado($empresa) {
    
    // solicitacao_resgate    
    global $wpdb;
 
    $result  = $wpdb->get_results("SELECT solRes.idresgate, solRes.dtsolicitacao ,solRes.cnpjemp, ben.id as idbeneficio, "
            . "ben.descricao, solRes.status, ben.qtdpontos, solRes.dtvencimento , "
            . "solRes.cpfcliente, cli.nome_completo , cli.src_selfie "
            . "FROM solicitacao_resgate solRes "
            . "INNER JOIN beneficios ben ON solRes.cdbeneficio = ben.id "
            . "INNER JOIN empresas emp ON solRes.cnpjemp = emp.cnpj "
            . "INNER JOIN clientes cli ON solRes.cpfcliente = cli.cpf "
            . "WHERE solRes.cnpjemp = '$empresa' AND solRes.status = 'solicitado' "
            . "ORDER BY solRes.dtsolicitacao DESC");   
    return $result;
           
}


function listarSolicitacaoRestageEmpresaApenasEntregue($empresa) {
    
    // solicitacao_resgate    
    global $wpdb;
 
    $result  = $wpdb->get_results("SELECT solRes.idresgate, solRes.dtsolicitacao ,solRes.cnpjemp, ben.id as idbeneficio, "
            . "ben.descricao, solRes.status, ben.qtdpontos, solRes.dtvencimento , "
            . "solRes.cpfcliente, cli.nome_completo , cli.src_selfie "
            . "FROM solicitacao_resgate solRes "
            . "INNER JOIN beneficios ben ON solRes.cdbeneficio = ben.id "
            . "INNER JOIN empresas emp ON solRes.cnpjemp = emp.cnpj "
            . "INNER JOIN clientes cli ON solRes.cpfcliente = cli.cpf "
            . "WHERE solRes.cnpjemp = '$empresa' AND solRes.status = 'entregue' "
            . "ORDER BY solRes.dtsolicitacao DESC");   
    return $result;
           
}


function listarSolicitacaoRestageEmpresaApenasEstornado($empresa) {
    
    // solicitacao_resgate    
    global $wpdb;
 
    $result  = $wpdb->get_results("SELECT solRes.idresgate, solRes.dtsolicitacao ,solRes.cnpjemp, ben.id as idbeneficio, "
            . "ben.descricao, solRes.status, ben.qtdpontos, solRes.dtvencimento , "
            . "solRes.cpfcliente, cli.nome_completo , cli.src_selfie "
            . "FROM solicitacao_resgate solRes "
            . "INNER JOIN beneficios ben ON solRes.cdbeneficio = ben.id "
            . "INNER JOIN empresas emp ON solRes.cnpjemp = emp.cnpj "
            . "INNER JOIN clientes cli ON solRes.cpfcliente = cli.cpf "
            . "WHERE solRes.cnpjemp = '$empresa' AND solRes.status = 'estornado' "
            . "ORDER BY solRes.dtsolicitacao DESC");   
    return $result;
           
}

function baixaSolicitacaoResgate($idresgate)
{
     
    global $wpdb; 
        
    $resultado = $wpdb->update('solicitacao_resgate', 
            array(
                'status'=>'entregue',
                'dtresgate' => date("Y-m-d H:i")
            ), 
            array('idresgate'=>$idresgate ));
    
    return $resultado;
    
}

function solicitacaoRestageEmAberto($cpf, $emp) {
    
    // solicitacao_resgate    
    global $wpdb;
    
    $result1 = $wpdb->get_results("SELECT emp.razao_social,  "
            . "emp.nome_fantasia, ben.descricao, solRes.status "
            . "FROM solicitacao_resgate solRes "
            . "INNER JOIN beneficios ben ON solRes.cdbeneficio = ben.id  "
            . "INNER JOIN empresas emp ON solRes.cnpjemp = emp.cnpj "
            . "WHERE cpfcliente = '$cpf' AND solRes.status = 'solicitado' AND solRes.cnpjemp = '$emp' ");
    
    // $result  = $wpdb->get_results("SELECT * FROM solicitacao_resgate WHERE cpfcliente = '$cpf'  ORDER BY dtsolicitacao DESC ");
    return $result1;
          
}

function estornarSolicitarResgate($idresgate)
{
    
    global $wpdb;
    $dataEstorno = date("Y-m-d H:i");
    $resultado = $wpdb->update('solicitacao_resgate', 
            array('estorno'=>'s', 'dthrestorno' => $dataEstorno, 'status'=> 'estornado' ), 
            array('idresgate'=>$idresgate));
    return $resultado;
    
}

