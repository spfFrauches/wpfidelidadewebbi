<?php

function cadastroClienteViaSite() {
    
    if(!empty($_FILES['selfcliente'])):  
        
        $targetDir = "./wp-content/themes/fidelidade/uploadfidelidade/clientes_selfie/";    
               
        chmod ($targetDir, 0777);
        
        /* Renomeando o arquivo com base na data e hora */
        $datahr = date("Y-m-d h:i:s");
        $datahr  = str_replace(" ", "", $datahr);
        $datahr  = str_replace("-", "", $datahr);
        $datahr  = str_replace(":", "", $datahr); 
        $extension = explode(".", $_FILES["selfcliente"]["name"]);
        $renomearArquivo = $datahr.".".$extension[1];
        
        $dir = get_bloginfo('template_url')."/uploadfidelidade/clientes_selfie/".basename($_FILES["selfcliente"].$renomearArquivo);
        $target_file = $targetDir . basename($_FILES["selfcliente"].$renomearArquivo); 
        
        if (move_uploaded_file ($_FILES['selfcliente']['tmp_name'], $target_file)):
            else:
            $dir = '';
            $target_file = '';
        endif;
    endif;

    $arrayCliente = [
        'nome_completo' => $_POST['nome_completo'],
        'cpf' => $_POST['cpf_cliente'],
        'data_nascimento' =>  $_POST['data_nascimento'],
        'email' => $_POST['email'],
        'fone' => $_POST['telefone'],
        'senha' =>  $_POST['senha'],
        'sexo' =>  $_POST['sexo'],
        'termos_uso' => 'SIM',
        'src_selfie' => $dir,
        'path_selfie' => $target_file
    ];
        
    if (insertDBCliente($arrayCliente)):
        return true;
    else:
        return false;
    endif;
   
}


function alterarSenhaDashBoard() { 
     
    if (isset($_POST['novasenha']) && isset($_POST['novasenha_confirma']) ):        
        if ($_POST['novasenha'] == $_POST['novasenha_confirma']):  
            if (isset($_POST['senhaatual'])): 
                if (autenticarLoginCliente($_SESSION['dados_cliente'][0]->cpf, $_POST['senhaatual'])):
                    if (alterarSenhaCliente($_POST['novasenha'], $_SESSION['dados_cliente'][0]->cpf)):
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
    return "NadaInformado";
}






/*
 * Tornar obsoleto e excluir...
function verificarSeCadastroViaSite()
{    
    if (isset($_POST['tipo_cadastro']) && $_POST['tipo_cadastro'] == 'site' ) {
        return true;
    } else {
        return false;
    }  
}
 * 
function swalMsgAlertaClienteExcluido($msg) {    
    echo "<script>"; 
    echo "Swal.fire(
            'Operação realizada',
            '$msg',
            'success'
        )"; 
    echo "</script>";
    
}
 * function  swalMsgAlertaClienteErro($msg) {
    echo "<script>"; 
    echo "Swal.fire(
            'Ops',
            '$msg',
            'warning'
        )"; 
    echo "</script>";
}
 * 
function  swalMsgAlertaClienteNaoExcluido($msg) {
    echo "<br/>";
    echo '<div class="alert alert-warning" role="alert">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo "$msg";
    echo '</div>';
}
 * 
function swalMsgAlertaClienteCadastrado($msg) {
    
    echo "<script>"; 
    echo "Swal.fire(
            'Operação realizada',
            '$msg',
            'success'
        )"; 
    echo "</script>";
    
}
 * 
 */
  
?>
