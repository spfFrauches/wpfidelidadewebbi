<?php

function recuperacao_senha($email)
{
    
    $tabela = "clientes";
    global $wpdb; 
    $resultado =  $wpdb->get_results( "SELECT * FROM $tabela WHERE email = '$email' " );
    
    if ($resultado):
        
        $to = $email;    
        $subject = 'Webbi Fidelidade - Recuperando a senha';
        $message = 'Foi solicitada uma recuperação de senha do <b>Webbi Fidelidade</b>';
        $message .= "<br/>";
        $message .= "Sua senha é.: ".$resultado[0]->senha;
        $message .= "<hr/>";
        $message .= "Digite essa nova senha...";
        $headers = array('Content-Type: text/html; charset=UTF-8');
        if (wp_mail( $to, $subject, $message, $headers )):
            return 'enviado';
        else:
            return 'nao-enviado';
        endif;
        
    endif;
    
    if (!$resultado):
        
        return "no-email";
        
    endif;
   
    
    /*
    
     * 
     */
     
}
