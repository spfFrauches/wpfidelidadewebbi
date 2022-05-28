<?php 

/* Template Name: Painel Cliente Resgate Beneficios */ 
$_SESSION['url_referencia'] = '';
get_header('painel');
include( get_template_directory() . '/models/model_clientes.php' );

$caminhoImgDefault = get_bloginfo('template_url')."/img/default-user-1.png";   
$dadosCliente = buscarClientes($_SESSION['dados_cliente'][0]->cpf);

if ($_SESSION['login_painel'] != 'cliente'):
    $url = get_bloginfo('url')."/login";
    header("Location:$url");
    exit("A sessão foi expirada ou é invalida");
endif; 

    
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-lg-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Solicitar Resgate de Beneficios</h1>
    </div> 
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-secondary rounded shadow-sm">
        <div class="lh-100"> 
            <h6 class="mb-0 text-white lh-100">Ola, <?=  explode(' ',trim($dadosCliente[0]->nome_completo))[0] ?></h6>
            <small></small>
        </div>
    </div>
     
</main>

<?php get_footer('painel'); ?>



