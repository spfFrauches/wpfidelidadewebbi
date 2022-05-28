<?php 

/* Template Name: Painel Cliente Meus Resgates */ 
$_SESSION['url_referencia'] = '';
get_header('painel');
include( get_template_directory() . '/models/model_clientes.php' );
include( get_template_directory() . '/models/model_solicitacao_resgate.php' );

$caminhoImgDefault = get_bloginfo('template_url')."/img/default-user-1.png"; 
$cpfcliente = $_SESSION['dados_cliente'][0]->cpf;
$dadosCliente = buscarClientes($cpfcliente);
$solitacaoResgate = listarSolicitacaoRestage($cpfcliente);


if ($_SESSION['login_painel'] != 'cliente'):
    $url = get_bloginfo('url')."/login";
    header("Location:$url");
    exit("A sessão foi expirada ou é invalida");
endif; 

$cnpjemp = $_REQUEST["cnpj"];

$sqlConfigEmpresa = "SELECT  * FROM empresa_config  WHERE cnpjemp = '$cnpjemp' ";
$resutadoConfiguracaoEmpresa = $wpdb->get_results( $sqlConfigEmpresa );

 
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
    <div class="d-flex justify-content-between flex-wrap flex-lg-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Meus Resgates</h1>
        <div class="btn-toolbar mb-2 mb-md-0 btn-nav-forload">
            <a href="<?= get_bloginfo('url')."/painel-cliente" ?>" class="btn btn-sm btn-outline-secondary">
                <i class="fa fa-gift" aria-hidden="true"></i> Home
            </a>
        </div>
    </div>  
     
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-secondary rounded shadow-sm">
        <!-- <img class="mr-3" src="" alt="" width="48" height="48"> -->
        <div class="lh-100"> 
            <h6 class="mb-0 text-white lh-100">Ola, <?=  explode(' ',trim($dadosCliente[0]->nome_completo))[0] ?></h6>
            <small>Veja seus historios de solicitações e restages de pontos</small>
        </div>
    </div>
    
    <?php
    /*
        echo "<pre>";
        var_dump($solitacaoResgate);
        echo "</pre>";
    */
    ?>
    
    <?php foreach ($solitacaoResgate as $key => $value): ?>
    
        <div class="d-flex text-muted pt-3">
            <div class="div-resolut2">
                <img class="img-resolut2" src="" >
            </div>
            <div class="small lh-sm border-bottom w-100" style="margin-left: 10px; margin-top: 10px">
                <div class="d-flex justify-content-between">
                    
                    <?php if ($value->status == 'vencido'): ?>
                        <s>
                        <strong class="text-warning">
                    <?php endif; ?>                   
                        Onde pegar.:
                        <?= $value->razao_social ?>                          
                    <?php if ($value->dtvencimento <= date("Y-m-d")): ?>
                        </strong>
                        </s>        
                    <?php endif; ?>
                                   
                    <a href="#" style="text-decoration: none">
                        Status.: &nbsp; 
                        <?php if ($value->status == 'solicitado'): ?>
                        <span class="badge rounded-pill bg-danger" >  
                        <?php endif; ?>   
                        <?php if ($value->status == 'entregue'): ?>
                        <span class="badge rounded-pill bg-success" >  
                        <?php endif; ?>  
                        <?php if ($value->status == 'vencido'): ?>
                        <span class="badge rounded-pill bg-warning" >  
                        <?php endif; ?>  
                            <?= ucfirst($value->status); ?>
                        </span>
                    </a>                 
                                                           
                </div>
                <span class="d-block"><b>Item.: </b><?= $value->descricao ?> </span>
                <span class="d-block" style="margin-bottom: 10px">
                    <b>Solicitado em.: </b>
                    <?= date('d/m/Y', strtotime($value->dtsolicitacao))  ?> 
                    
                    <?php if ($value->status == 'entregue'): ?>
                        &nbsp;&nbsp<b>Entregue em.:</b>
                        <?= date('d/m/Y', strtotime($value->dtresgate)) ?>
                    <?php else: ?>
                        <b class="text-warning">&nbsp; | Vence em.: <?= date('d/m/Y', strtotime($value->dtvencimento)) ?> </b>
                    <?php endif; ?>
                   
                </span>
            </div>
        </div>
    <?php endforeach; ?>
    
    <br/>
       
</main>

<?php get_footer('painel'); ?>



