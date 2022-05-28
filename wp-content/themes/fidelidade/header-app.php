<!doctype html>
<html lang="en">
    
    <head>  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/dist/css/bootstrap5-1.min.css" >
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/dist/css/product.css" >
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/dist/font-awesome-4.7.0/css/font-awesome.css" >   
        <script src="<?php bloginfo('template_url') ?>/dist/js/jquery-3.5.1.min.js" ></script>
        <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
        <title>Fidelidade</title>
        <?php wp_head(); ?> 
        
    </head>
    <?php  include( get_template_directory() . '/functions/functions_global.php' ); ?>
    <body>
        
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-2">                
                <div class="row"> 
                    <div class="col-lg-12 m-2">
                        <h5 class="text-white h4"> Marcações CashBack </h5>
                        <span class="text-muted"><?= $_SESSION['dados_empresa'][0]->nome_fantasia ?>.:</span>
                        <span class="text-muted"><?= $_SESSION['dados_empresa'][0]->cnpj ?></span>
                        <br/><br/>
                        <a href="<?php bloginfo('home') ?>/login-app" type="button" class="btn btn-outline-light btnSairPainel">Sair</a> 
                    </div>
                    <div class="col-lg-12 d-flex justify-content-end p-2">
                         
                    </div>
                    
                </div>
            </div>
        </div>
        
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

