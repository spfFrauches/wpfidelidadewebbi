<?php 

    /* Template Name: Painel Fidelidade */ 
    if (isset($_SESSION['login_painel']) && $_SESSION['login_painel'] == 'admin') :
    get_header('painel');
    
?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Painel Fidelidade <small>Admin</small></h1>
            <br/>            
        </div>
              
        <?php //var_dump($_SESSION['dados_empresa'][0]->razao_social); ?>
        
        <br/>
        <h2 class="h3">Olá, <small> Administrador </small></h2>
        <p>           
            Painel destinado a administração do fidelidade 
        </p>
        <?php // var_dump($_SESSION); ?>
    </main>

<?php 
    else : 
        $url = get_bloginfo('url')."/login";
        echo "<script>";
        echo "window.location.href = '$url'";
        echo "</script>"; 
     endif;
?>

<?php get_footer('painel') ?>




