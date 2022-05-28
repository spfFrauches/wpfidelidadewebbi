<!doctype html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/dist/css/bootstrap5-1.css" >
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/dist/css/product.css" >
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/dist/font-awesome-4.7.0/css/font-awesome.css" >   
        <script src="<?php bloginfo('template_url') ?>/dist/js/jquery-3.5.1.min.js" ></script>
        <title>Webi - Fidelidade</title>
        <?php wp_head(); ?> 
        <style>
            .navbar-text a:hover, .navbar-light .navbar-text a:focus {
                color: #fff !important; 
            }
           
        </style>
    </head>
    <?php  include( get_template_directory() . '/functions/functions_global.php' ); ?>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="fa fa-fire fa-2x" aria-hidden="true"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php bloginfo('home') ?>">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="#">Planos e Assinaturas</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">                             
                            
                            <li class="nav-item active">
                                <a class="nav-link" href="#">&nbsp;</a>
                            </li>
                           
                            <li class="nav-item">
                                <a  href="<?php bloginfo('home') ?>/login" class="btn btn-outline-dark btn-Entrar-noLogin">Entrar</a>
                            </li>
                        </ul>
                    </span>
                </div>
            </div>
        </nav>
        
        

