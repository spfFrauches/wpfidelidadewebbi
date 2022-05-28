<?php 

    require '../../../../wp-load.php';
    require ( get_template_directory() . '/models/model_marcacao.php' );
    require ( get_template_directory() . '/models/model_clientes.php' );
    require ( get_template_directory() . '/models/model_empresa_config.php' );
    
    date_default_timezone_set('America/Bahia');  
    
    $configuracaoEmpresa = verConfigMarcacaoEmpresa($_SESSION['dados_empresa'][0]->cnpj);
    
    //var_dump($configuracaoEmpresa);
    
    /* 1 tela/load da marcação - ao clicar em Continuar na tela de Marcações */
    /* Verificando quem é o cliente e montando o JSON dos dados cadastrais. */

    function verificaTempoEntreMarcacao($tempoConfig = '0', $cpf)
    {
        $ultimaMarcacaoCliente  = ultimaMarcacaoCliente($cpf);
        $ultimaMarcacaoCliente  = $ultimaMarcacaoCliente[0]->dtultmarcacao;
        $date1 = date("Y-m-d H:i:s");
        $date2 = $ultimaMarcacaoCliente;
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);
        return $hour = abs($timestamp2 - $timestamp1)/(60*60); 
    }
    
    if (isset($_POST['cpf']) && !isset($_POST['marcarConfere']) ) {

        $cliente_marcacao = $_POST['cpf'];
        $seExiste = verificarSeExiste($cliente_marcacao);
        $tempoEntreMarcacao = verificaTempoEntreMarcacao($configuracaoEmpresa[0]->tempoEntreMarcacao, $_POST['cpf']);
        
        if ($configuracaoEmpresa[0]->tempoEntreMarcacao == 0):
            if ($seExiste) {
                $jsonSeExiste = json_encode($seExiste); 
                //imprime uma string em formato json
                echo $jsonSeExiste; 
                exit();
            } else {
                echo "false";
                exit();
            }  
        endif;

        if ($tempoEntreMarcacao < $configuracaoEmpresa[0]->tempoEntreMarcacao):
            echo json_encode("tempoLimiteMarcacao"); 
            exit();
        else:
            if ($seExiste) {
                echo json_encode($seExiste); 
                exit();
            } else {
                echo "false";
                exit();
            }  
        endif;
        
    }
           
    if (isset($_POST['marcar']) && $_POST['marcar']==1 ) {
               
        date_default_timezone_set('America/Bahia');    
        $dataHoraMarcacao = date('Y-m-d H:i');
        $cpfMarcacao  = $_POST['dataCPF'];
        $cnpjMarcacao = $_SESSION['dados_empresa'][0]->cnpj;
        $valorMarcacao = $_POST['valor'];
        $tipoMarcacao = $_POST['tipoMarcacao'];
        $obsadicional = $_POST['obsadicional'];
                       
        $dadosMarcacao = [
            "cpf"  => $cpfMarcacao,
            'cnpj' => $cnpjMarcacao,
            'datahora' => $dataHoraMarcacao,
            'valor' => $valorMarcacao,
            'tipo' => $tipoMarcacao,
            'obsadicional' => $obsadicional
        ]; 
        
        echo json_encode($dadosMarcacao);

    }
    
    if (isset($_POST['marcarConfere']) && $_POST['marcarConfere'] == 1 ) {
                
        $cpfMarcacao = $_POST['cpf'];
        $cnpjMarcacao =  $_POST['cnpj'];  
        $valorMarcacao = $_POST['valorMarcacao'];
        $datahora = date("Y-m-d H:i:s");
        $protocolo = 'teste';
        $tipo_marcacao = $_POST['tipoMarcacao'];
        $obsadicional = $_POST['obsadicional'];
        
        $percentual = $configuracaoEmpresa[0]->percentual_vlrcompra;       
        $expiraPontos = $configuracaoEmpresa[0]->tempoExpirarPontos;
        
        $pontos = ($valorMarcacao *  ($percentual /100));
        $pontos = number_format($pontos, 2);
        
        if ($expiraPontos == '0'):
            $dataExpiracao = '2099-12-31';  
        else:
            $dataExpiracao = date('Y-m-d', strtotime("+{$expiraPontos} days",strtotime($datahora)));   
        endif;
                     
        $valorMarcacaoSemPonto  = str_replace('.', '', $valorMarcacao);
        $valorMarcacaoFormatado  = str_replace(',', '.', $valorMarcacaoSemPonto);

        $arrayLigacao = [
            'cpfCliente' => $cpfMarcacao,
            'cnpjEmpresa' => $cnpjMarcacao,
        ];
        
        $arrayMarcacao = [        
            'cnpjemp' => $cnpjMarcacao,
            'cpfcli' => $cpfMarcacao,
            'datamarcacao' => $datahora,
            'valormarcacao' => $valorMarcacaoFormatado,
            'protocolomarcacao' => $protocolo,
            'tipomarcacao' => $tipo_marcacao,
            'porcentagemPontos' => $percentual,
            'pontos' => $pontos,
            'dias_expirar' => $expiraPontos,
            'data_expiracao' => $dataExpiracao,
            'obs_marcacao' => $obsadicional
        ];
       
        $marcarCartao = marcarCliente($arrayLigacao, $arrayMarcacao);

        if ($marcarCartao):
            $marcacoes = listarMarcacaoCliente($cpfMarcacao, $cnpjMarcacao);
            $qtdMarcacoes = count($marcacoes);       
            $configEmpresa = listarConfiguracaoEmpresa($cnpjMarcacao);
            exit();
        endif;
        exit();
               
    } 
    

?>