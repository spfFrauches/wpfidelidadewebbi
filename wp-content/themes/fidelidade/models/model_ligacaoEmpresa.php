<?php

function buscarEmpresaLigadaAoCliente($cliente) {
    
    global $wpdb;
    
    $sql = "SELECT * FROM ligacaoclienteempresa tbsligacao "
            . "JOIN empresas emp ON tbsligacao.cnpjemp = emp.cnpj "
            . "WHERE tbsligacao.cpfcli = '$cliente' ";
    
    $resultCliente  = $wpdb->get_results($sql);
    return $resultCliente;
    
}
