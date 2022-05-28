<?php

define ("NOME_APLICACAO", 'Webi Club Fidelidade');
define ('VLRSIMULADORMOEDAAPP' , '10');

function checkLogadoEmpresa()
{
    if ($_SESSION['login_painel'] != 'empresa'):
        $url = get_bloginfo('url')."/login";
        header("Location:$url");
        exit("A sessão foi expirada ou é invalida");
    endif; 
}

