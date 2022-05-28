<?php 
/* Template Name: Painel Cliente */ 
get_header('painel');

if (!isset($_SESSION['login_painel']) && $_SESSION['login_painel'] != 'cliente') :

    $url = get_bloginfo('url')."/login";
    header("Location:$url");
    exit("A sessão foi expirada ou é invalida");

endif;

include( get_template_directory() . '/models/model_marcacao.php' ); 
include( get_template_directory() . '/models/model_empresa.php' ); 
include( get_template_directory() . '/models/model_ligacaoEmpresa.php' ); 
$minhasEmpresas = buscarEmpresaLigadaAoCliente($_SESSION['dados_cliente'][0]->cpf);
        
?>

<style>
    
    .div-resolut {
        /* border: 1px solid black; */
        width: 120px; 
        /* height: 120px; */ 
    }

    .img-resolut {
        width: 120px; 
        height: 120px; 
        object-fit: contain;
      }
    
</style>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Meu <?= NOME_APLICACAO ?></h1>  
        <div class="btn-toolbar mb-2 mb-md-0 btn-nav-forload">
            <a href="<?= get_bloginfo('url')."/resgates-cliente" ?>" class="btn btn-sm btn-outline-secondary">
                <i class="fa fa-home" aria-hidden="true"></i> Meus Resgates
            </a>
        </div>
    </div> 
    
    <?php
        /*
            echo "<pre>";
            var_dump($minhasEmpresas);
            echo "</pre>"; 
        */ 
    ?>
    
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-secondary rounded shadow-sm">
        <!-- <img class="mr-3" src="" alt="" width="48" height="48"> -->
        <div class="lh-100"> 
          <h6 class="mb-0 text-white lh-100">Olá, <?= $_SESSION['dados_cliente'][0]->nome_completo ?></h6>
          <small>MegaChic Fidelidade</small>
        </div>
    </div>
        
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Meus locais de compra</h6>
        <?php if (!$minhasEmpresas): ?>
            <div class="col-lg-12 mt-5 mb-1">
                Ainda não existem registros de compras 
                no <?= NOME_APLICACAO ?>
            </div>
        <?php endif; ?>
    </div>
       
    <div class="row p-2 d-flex">    
        <?php foreach ($minhasEmpresas as $keyEmp => $valueEmp) : ?>                
            <div class="col p-1 div-resolut mt-1"> 
                <p class="p-2 text-center" style="font-size: 9px; margin-top: -5px;">
                    Estabelecimento.: 
                </p>
               
                <div class="text-center">
                    <img class="img-resolut img-thumbnail rounded-circle p-2" src="<?= $valueEmp->logoempsrc ?>" width="90px">
                </div> 
                
                <div class="p-2 text-center ">                  
                    <a 
                        href="<?= get_bloginfo('url') ?>/painel-cliente/extrato-pontos/?cnpj=<?= $valueEmp->cnpjemp ?>" 
                        class="btn btn-outline-secondary btn-sm btn-nav-forload" 
                        style="font-size:10px">
                        Meu extrato
                    </a>
                    
                     <p class="p-2 text-center" style="font-size: 11px; margin-top: -5px;">
                        <?= $valueEmp->nome_fantasia ?>
                    </p>
                </div>
            </div>                        
        <?php endforeach; ?>
    </div>
    
    <br/><br/>
    

</main>

<?php get_footer('painel') ?>




