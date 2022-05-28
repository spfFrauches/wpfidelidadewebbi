<?php

function autenticacaoApp() {
    
    $analisarLogin = analisarLogin($_POST['cnpj_cpf']);
    
    if (!$analisarLogin):
        return $msg = "Dados de acesso invalidos!" ;
    
    else:
        
        if ($analisarLogin == 'empresa') {

            if (!autenticarLoginEmpresa($_POST['cnpj_cpf'], $_POST['passwd'])):
                return $msg = "Dados de acesso invalidos!" ; 
                else:
                   redirecionarAppMarcacao($_POST['cnpj_cpf']); 
            endif;

        }
        
        if ($analisarLogin == 'cliente') {

            if (!autenticarLoginCliente($_POST['cnpj_cpf'], $_POST['passwd'])):
                return $msg = "Dados de acesso invalidos!" ; 
                else:
                   redirecionarPainelCliente($_POST['cnpj_cpf']);
            endif;

        } 
        
    
    endif;
    
    
}

function autenticacaoCompleta() {
      
    $analisarLogin = analisarLogin($_POST['cnpj_cpf']);
        
    if (!$analisarLogin){
        return $msg = "Dados de acesso invalidos!" ;
    } else {
            
        if ($analisarLogin == 'empresa') {

            if (!autenticarLoginEmpresa($_POST['cnpj_cpf'], $_POST['passwd'])):
                return $msg = "Dados de acesso invalidos!" ; 
                else:
                   redirecionarPainelEmpresa($_POST['cnpj_cpf']); 
            endif;

        }
        
        if ($analisarLogin == 'cliente') {

            if (!autenticarLoginCliente($_POST['cnpj_cpf'], $_POST['passwd'])):
                return $msg = "Dados de acesso invalidos!" ; 
                else:
                   redirecionarPainelCliente($_POST['cnpj_cpf']);
            endif;

        } 
        
        if ($analisarLogin == 'admin') {
            redirecionarPainelAdmin();
        }          
    }    
}

function analisarLogin($user) {
    
    if ($user == 'admin') {
        return "admin";
    }
    
    global $wpdb; 
    $resultadoBuscaCNPJ =  $wpdb->get_results( "SELECT cnpj from empresas where cnpj = '$user' and fl_situacao = 0 " );
    $resultadoBuscaCPF  =  $wpdb->get_results( "SELECT cpf  from clientes where cpf = '$user'" );
    
    if ($resultadoBuscaCNPJ){ 
        return "empresa";
    }
    if ($resultadoBuscaCPF) { 
        return "cliente";      
    }
    if (!$resultadoBuscaCPF && $resultadoBuscaCNPJ ) { return false; }
}

function autenticarLoginEmpresa($cnpj, $senha) {
    global $wpdb; 
    $analisarSenha =  $wpdb->get_results( "SELECT passwd from empresas where cnpj = '$cnpj'" );
    if ($analisarSenha[0]->passwd == $senha){
        return true;
    } else {
        return false;
    }   
}

function autenticarLoginCliente($cpf, $senha) {
    global $wpdb; 
    $analisarSenha =  $wpdb->get_results( "SELECT senha from clientes where cpf = '$cpf'" );
    if ($analisarSenha[0]->senha == $senha){
        return true;
    } else {
        return false;
    }   
}

function msgLoginInvalido($msg) {  
    echo "<br/>";
    echo '<div class="alert alert-warning" role="alert">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo "$msg";
    echo '</div>';
}

function redirecionarPainelEmpresa($cnpj){
    global $wpdb;      
    $carregarDadosEmpresa =  $wpdb->get_results( "SELECT * FROM empresas where cnpj = '$cnpj' " ); 
    $_SESSION['login_painel'] = 'empresa';        
    $_SESSION['dados_empresa'] = $carregarDadosEmpresa ;
    echo "<script>";
    echo "window.location.href='".get_bloginfo('url')."/painel-empresa'";
    echo "</script>";
}

function redirecionarAppMarcacao($cnpj){
    global $wpdb;      
    $carregarDadosEmpresa =  $wpdb->get_results( "SELECT * FROM empresas where cnpj = '$cnpj' " ); 
    $_SESSION['login_painel'] = 'empresa';        
    $_SESSION['dados_empresa'] = $carregarDadosEmpresa ;
    echo "<script>";
    echo "window.location.href='".get_bloginfo('url')."/marcacao-app/'";
    echo "</script>";
}

function redirecionarPainelCliente($cpf){
    global $wpdb;      
    $carregarDadosCliente =  $wpdb->get_results( "SELECT * FROM clientes where cpf = '$cpf' " ); 
    $_SESSION['login_painel'] = "cliente";
    $_SESSION['dados_cliente'] = $carregarDadosCliente ;
    echo "<script>";
    echo "window.location.href='".get_bloginfo('url')."/painel-cliente'";
    echo "</script>";
}

function redirecionarPainelAdmin(){   
    $_SESSION['login_painel'] = "admin";
    $_SESSION['dados_cliente'] = $carregarDadosCliente ;
    echo "<script>";
    echo "window.location.href='".get_bloginfo('url')."/painel'";
    echo "</script>";
}


?>
