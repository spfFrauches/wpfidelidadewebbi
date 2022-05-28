<?php

function nextIDCliente(){
    
    $tabela = "clientes";
    global $wpdb; 
    $resultado =  $wpdb->get_results( "SELECT MAX(id) as ID from $tabela" );
    return $resultado;
}

function insertDBCliente($array) {  
    
    $tabela = "clientes";
    global $wpdb; 
    $resultado = $wpdb->insert( "$tabela", $array, array('%s','%s', '%s','%s','%s', '%s', '%s', '%s', '%s') ) ;  
    
    if (!$resultado){
        return false;
    } else {
        return $resultado;
    }

}

function insertLigacaoClienteEmpresa($cpf, $cnpj) {
    
   $tabela = "ligacaoclienteempresa";
   global $wpdb;
   $data = array('cnpjemp' => $cnpj, 'cpfcli' => $cpf);
   $resultado = $wpdb->insert( "$tabela", $data, array('%s','%s') ) ;   
   return $resultado;
    
}

function verificarLigacao($cnpj, $cpf) {
    
    $tabela = "ligacaoclienteempresa";
    global $wpdb; 
    $resultado =  $wpdb->get_results( "SELECT * FROM $tabela WHERE cnpj = '$cnpj' AND cpf = '$cpf'" );
    return $resultado;
}

function cadastrarClienteInserirLigacao($arrayCliente, $arrayLigacao) {
    
    global $wpdb; 
    
    $tabela1 = "clientes";
    $tabela2 = "ligacaoclienteempresa";
    
    $wpdb->query ("START TRANSACTION");
    
    $cadastroCliente = $wpdb->insert( "$tabela1", $arrayCliente, array('%s','%s', '%s') ) ;
    $inserirLigacao  = $wpdb->insert( "$tabela2", $arrayLigacao, array('%s','%s') ) ;
    
    if ($cadastroCliente && $inserirLigacao) {
        $wpdb->query ("COMMIT");
        return true;
    } else {
        $wpdb->query ("ROLLBACK");
        return false;
    }   
    
}

function listarClientes() {
    
    $tabela = "clientes";
    global $wpdb; 
    $resultado =  $wpdb->get_results( "SELECT * FROM $tabela" );
    return $resultado;
    
}

function listarClienteFidelidade($cpf) {
    
    $tabela = "clientes";
    global $wpdb; 
    $resultado =  $wpdb->get_results( "SELECT * FROM $tabela where cpf = '$cpf'" );
    return $resultado;
    
}

function listarClientesLigados($cnpj) {
    
    global $wpdb;      
    $sql = " SELECT  A.id as IDLIG, A.CnpjEmp as CNPJ, B.id as IDCLI, B.nome_completo as NOME, "
            . "B.cpf as CPF, B.data_nascimento AS NASCIMENTO FROM ligacaoclienteempresa A left join clientes B "
            . "ON A.CpfCli = B.cpf "
            . "WHERE 1=1 AND A.CnpjEmp = '$cnpj'";
    //var_dump($sql);
    $resultado =  $wpdb->get_results($sql);    
    return $resultado;
}

function listarDadosCompletosClientesLigados($cnpj) {
    
    global $wpdb; 
    
    $sql = "SELECT  a.cnpjemp CNPJCPF, a.cpfcli CPF, b.nome_completo NOME, "
            . "(SELECT max(datamarcacao) FROM marcacao WHERE cpfcli = a.cpfcli and estorno is null or estorno <> 's') ULTMARC "
            . "FROM ligacaoclienteempresa a JOIN clientes b ON a.cpfcli = b.cpf "
            . "WHERE 1=1 AND a.cnpjemp = '$cnpj'"
            . "ORDER BY ULTMARC DESC";
    
    $resultado =  $wpdb->get_results($sql);    
    return $resultado;
    
}



function listarDadosCompletosClientesLigadosCalculandoPontosAtuais($cnpj) {
    
    global $wpdb; 
    
    $sql = "SELECT  a.cnpjemp CNPJCPF, a.cpfcli CPF, b.nome_completo NOME, "
            . "(SELECT max(datamarcacao) FROM marcacao WHERE cpfcli = a.cpfcli) ULTMARC , "
            . "(select sum(pontos) FROM marcacao WHERE cpfcli = a.cpfcli) SOMAPONTOS "
            . "FROM ligacaoclienteempresa a JOIN clientes b ON a.cpfcli = b.cpf "
            . "WHERE 1=1 AND a.cnpjemp = '$cnpj' ORDER BY ULTMARC desc ";
    
    $resultado =  $wpdb->get_results($sql);    
    return $resultado;
    
}

function verificarSeExiste($cpf) {
    $tabela = "clientes"; 
    global $wpdb; 
    $resultado =  $wpdb->get_results( "SELECT * FROM $tabela WHERE cpf = '$cpf' " );
    
    if ($resultado) { return $resultado; } 
    else { return false; }
}

function buscarClientes($cpf){ 
   $tabela = "clientes";
   global $wpdb;      
   $resultado =  $wpdb->get_results( "SELECT * FROM $tabela where cpf = '$cpf' " ); 
   return $resultado;
}

function seExisteEmail($email) {
    global $wpdb;      
    $resultado =  $wpdb->get_results( "SELECT * FROM clientes where email = '$email' " );
    
    if ($resultado) { return true; } 
    else { return false; }
}

function seExisteTelefone($telefone) {
    global $wpdb;      
    $resultado =  $wpdb->get_results( "SELECT * FROM clientes where fone = '$telefone' " );
    
    if ($resultado) { return true; } 
    else { return false; }
}

function clientesPorEmpresa($cnpj) {

    global $wpdb;      
    $resultado =  $wpdb->get_results( "SELECT cliente.nome_completo, cliente.data_nascimento, "
                . "cliente.fone  FROM "
                . "ligacaoclienteempresa tblig "
                . "INNER JOIN clientes cliente ON tblig.cpfcli = cliente.cpf "
                . "WHERE tblig.cnpjemp = '$cnpj' " );
    return $resultado;
    
}

function clientesAniversarioPorEmpresa($cnpj) {

    global $wpdb;      
    $resultado =  $wpdb->get_results( "SELECT cliente.nome_completo, cliente.data_nascimento, "
                . "cliente.fone  FROM "
                . "ligacaoclienteempresa tblig "
                . "INNER JOIN clientes cliente ON tblig.cpfcli = cliente.cpf "
                . "WHERE tblig.cnpjemp = '$cnpj' " );
    return $resultado;
    
}

function listarClientesPorEmpresa($cnpj) {
    /* Pesquisa a ser feita na tabela de ligação */
    global $wpdb;      
    $resultado =  $wpdb->get_results( "SELECT count(*) qtdTotalClientes "
                . "FROM ligacaoclienteempresa WHERE cnpjemp = '$cnpj' " );
    return $resultado[0]->qtdTotalClientes;
    
}

function alterarSenhaCliente($novasenha, $cpf){
    
    global $wpdb; 
    $resultado = $wpdb->update('clientes', array('senha'=>$novasenha), array('cpf'=>$cpf));
    return $resultado;
    
}


?>
