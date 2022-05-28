<?php

function configurarTipoMarcacao() {
    
   
    $dadosInsert = array();
    $dadosInsert['tipo_marcacao'] = $_POST['tipo_marcacao'];
    $dadosInsert['cnpjemp'] = $_SESSION['dados_empresa'][0]->cnpj ;
    $dadosInsert['dthr_ultima_alteracao'] = date('Y-d-m h:i:s');
    $dadosInsert['tempoExpiracao'] = $_POST['tempoExpiracao'];
    $dadosInsert['tempoExpiracaoResgate'] = $_POST['tempoExpiracaoResgate'];
    $dadosInsert['tempoEntreMarcacao'] = $_POST['tempoEntreMarcacao'];
    

    if ($_POST['tipo_marcacao'] == 'cash') {  
        
        $dadosInsert['percentual'] = $_POST['percentual'];     
        $dadosInsert['percentual']  = str_replace('.', '', $dadosInsert['percentual']);
        $dadosInsert['percentual']  = str_replace(',', '.', $dadosInsert['percentual']);
        
        if (isset($_POST['update']) && $_POST['update'] == 'sim'):
            
            $retorno =  updateConfiguracaoEmpresa($dadosInsert);
            
        
            else:
            $retorno =  inserirConfiguracao($dadosInsert);
            
        endif;
           
        return $retorno;
    }    
}

function alterarSenhaDashBoard() {
    
    if (isset($_POST['novasenha']) && isset($_POST['novasenha_confirma']) ): 
   
        if ($_POST['novasenha'] == $_POST['novasenha_confirma']):  
            
            if (isset($_POST['senhaatual'])):   
                
                if (autenticarLoginEmpresa($_SESSION['dados_empresa'][0]->cnpj, $_POST['senhaatual'])):
                    
                    if (alterarSenhaEmpresa($_POST['novasenha'], $_SESSION['dados_empresa'][0]->cnpj)):
                        return "SenhaAlterada";
                    endif;
                    
                else :
                    return "SenhaAtualInvalida";
                endif;
            endif;
            
        else:
            
            return "NovasSenhasInvalidas";
            
        endif;      
    endif;
    
}


?>
