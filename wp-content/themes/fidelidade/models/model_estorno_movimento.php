<?php

function listarMovimentosClientes($cnpjemp) 
{
    
    global $wpdb;
       
    $sql = "";
    $sql .= "SELECT mark.id, mark.cnpjemp, mark.cpfcli, ";
    $sql .= "cli.nome_completo, mark.datamarcacao, mark.valormarcacao, ";
    $sql .= "mark.tipomarcacao, mark.porcentagemPontos, mark.pontos, mark.estorno,  ";
    $sql .= "mark.obs_estorno, mark.dthr_estorno  ";
    $sql .= "FROM marcacao mark  ";
    $sql .= "INNER JOIN clientes cli ON mark.cpfcli = cli.cpf ";
    $sql .= "WHERE mark.cnpjemp = '$cnpjemp' ";
    $sql .= "ORDER BY mark.datamarcacao DESC";
    
    $resultCliente  = $wpdb->get_results($sql);
    return $resultCliente;
    
}

function listarMovimentosClientesSemEstorno($cnpjemp) 
{
    
    global $wpdb;
       
    $sql = "";
    $sql .= "SELECT mark.id, mark.cnpjemp, mark.cpfcli, ";
    $sql .= "cli.nome_completo, mark.datamarcacao, mark.valormarcacao, ";
    $sql .= "mark.tipomarcacao, mark.porcentagemPontos, mark.pontos ";
    $sql .= "FROM marcacao mark  ";
    $sql .= "INNER JOIN clientes cli ON mark.cpfcli = cli.cpf ";
    $sql .= "WHERE mark.cnpjemp = '$cnpjemp' AND mark.estorno IS NULL or estorno <> 's' ";
    $sql .= "ORDER BY mark.datamarcacao DESC";
    
    $resultCliente  = $wpdb->get_results($sql);
    return $resultCliente;
    
}

function estornarMovimento($idmarcacao, $obsestorno)
{
    global $wpdb;   
    $dthrestorno = date("Y-m-d H:i");
    $arrayCampos =  [ 
                        'estorno'=>'s',
                        'obs_estorno' => "$obsestorno",
                        'dthr_estorno' => "$dthrestorno"
                    ];
    $resultado = $wpdb->update('marcacao', $arrayCampos, array('id'=>$idmarcacao));
    return $resultado;      
}

function estornarMovimentoRetidaBrinde($idResgate)
{
    global $wpdb;   
    
     date_default_timezone_set('America/Bahia');
    
    $dthrestorno = date("Y-m-d H:i");
    
    $obsestorno = "Estorno do resgate/baixa do brinde";
    
    $arrayCampos =  [ 
                        'estorno'=>'s',
                        'obs_estorno' => "$obsestorno",
                        'dthr_estorno' => "$dthrestorno"
                    ];
    $resultado = $wpdb->update('marcacao', $arrayCampos, array('protocolomarcacao'=>$idResgate));
    return $resultado;      
}

function naoEstornarAposResgate($idmarcacao, $cliente, $empresa)
{
    global $wpdb;
      
    $sql = "";
    $sql .= "SELECT max(dtsolicitacao) dtultimasolicitacao FROM solicitacao_resgate 
            WHERE cpfcliente = '$cliente' AND cnpjemp = '$empresa' 
            AND  ( estorno <> 's' OR estorno is null)";
    
    $dtUltimaSolicitacaoResgate  = $wpdb->get_results($sql);

    
    $sql2 = "";
    $sql2 .= " SELECT datamarcacao FROM marcacao 
                where cpfcli = '$cliente' and cnpjemp = '$empresa' 
                and id = '$idmarcacao' ";
    $dataMarcacao  = $wpdb->get_results($sql2);
    



    if( strtotime($dataMarcacao[0]->datamarcacao) > strtotime($dtUltimaSolicitacaoResgate[0]->dtultimasolicitacao) )
    {
        return "ok";
    } else {
        return 'naoestonar';
    }
}

function limitePara24hEstorno($dataMovimento)
{
    
    date_default_timezone_set('America/Bahia');
    
    $dataAtual = date("Y-m-d H:i");
    
    $timestamp1 = strtotime($dataAtual);
    $timestamp2 = strtotime($dataMovimento);
    
    $hour = abs($timestamp2 - $timestamp1)/(60*60); 
    
    if ($hour < 24):
        return true;
    endif;
    
     if ($hour > 24):
        return false;
    endif;
    
}
