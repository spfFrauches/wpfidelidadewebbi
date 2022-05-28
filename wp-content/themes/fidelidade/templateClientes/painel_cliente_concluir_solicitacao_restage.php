<?php

/* Template Name: Painel Cliente - Concluir Solicitação Resgate*/ 
get_header('painel');

include( get_template_directory() . '/models/model_solicitacao_resgate.php' );
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    $cnpj = $_REQUEST["cnpjemp"];
endif;
    
if ($_SESSION['jaInserido'] == 'sim'):
    $urlRedirect = get_bloginfo('url')."/painel-cliente/extrato-pontos/?cnpj=$cnpj";
    echo "<script>window.location.href = '$urlRedirect'</script>";
    exit;
endif;

if ($_SERVER['REQUEST_METHOD'] == 'POST') :      
    if (isset($_POST['solicitacao_resgate'])):
        $inserirSolicitacao = inserirSolicitacao($_POST); 
        if($inserirSolicitacao){
            $_SESSION['jaInserido'] = 'sim'; 
        }        
    endif;    
endif;

?>

<?php if ($inserirSolicitacao): ?>

<div class="container">
    <div class="row mt-5 mb-5" style="color: #0f5132">
        
        <div class="col-lg-12 text-center">
            <i class="fa fa-check fa-5x" aria-hidden="true"></i>
        </div>
    </div>
    
    <div class="row" style="color: #0f5132">
        <div class="col-lg-12 text-center">
            <p style="font-size: 20px">Resgate solicitado com sucesso!</p>
        </div>
    </div>
    
    <div class="row" style="color: #0f5132">
        <div class="col-lg-12 text-center">
            <a class="btn btn-outline-success btn-nav-forload" href="<?= get_bloginfo('url') ?>/painel-cliente/extrato-pontos/?cnpj=<?= $cnpj ?>">
                Voltar
            </a>
        </div>
    </div>
</div>
<?php endif; ?>

<?php get_footer('painel'); ?>


