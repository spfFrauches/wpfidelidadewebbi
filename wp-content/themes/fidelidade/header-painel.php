<!doctype html>
<html lang="en">
    
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

        <!-- <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/util/DataTables/datatables.css" > -->
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/dist/css/bootstrap5-1.min.css" >
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/dist/css/dashboard5-1.css" >
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/dist/css/style.css" >
        
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/dist/font-awesome-4.7.0/css/font-awesome.css" >   
        <script src="<?php bloginfo('template_url') ?>/dist/js/jquery-3.5.1.min.js" ></script>
        
        
        <!-- <script src="<?php bloginfo('template_url') ?>/util/DataTables/datatables.js" ></script> -->

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        
        <title>Painel Fidelidade</title>
        
    </head>
    <?php  include( get_template_directory() . '/functions/functions_global.php' ); ?>
    <body>
        
        <?php 
        
           if (isset($_SESSION['login_painel']) && $_SESSION['login_painel'] == 'admin') {
               include( get_template_directory() . '/parcials/navbar_gestor_fidelidade.php' );
           }
           
           else if (isset($_SESSION['login_painel']) && $_SESSION['login_painel'] == 'empresa') { 
               include( get_template_directory() . '/parcials/navbar_gestor_empresas.php' );
           }
           
           else if (isset($_SESSION['login_painel']) && $_SESSION['login_painel'] == 'cliente') { 
               include( get_template_directory() . '/parcials/navbar_painel_cliente.php' );
           }
            
            
        ?>
               
           

