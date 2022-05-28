<style>
    
    @media only screen and (max-width: 800px) {
        .descricaoBeneficio {
            margin-left: 200px !important;   
        }
    }
    
</style>

<?php 

/* Template Name: Painel Empresa - Beneficios por pontos */ 
$_SESSION['url_referencia'] = 'empresa-beneficios-por-pontos';
get_header('painel');
include( get_template_directory() . '/models/model_beneficio.php' );
include( get_template_directory() . '/functions/functions_beneficios.php' );

if (!isset($_SESSION['login_painel'])) :
    $url = get_bloginfo('url')."/login";
    header("Location:$url");
    exit("Sessão expirada ou invalida");
endif ; 

checkIsUpdatedBeneficios();

$listagemBeneficios = listarBeneficiosPorEmpresa($_SESSION['dados_empresa'][0]->cnpj);
     
?>

<style>
    .wrapperimg {
        width: auto;
        height: 100%;
        max-width: none;
        position:absolute;
        top: 0;   
    }   
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3">
      
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Beneficios <small>por pontos</small></h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
            </div>
            <a href="<?= get_bloginfo('url') ?>/painel-empresa/cadastro-beneficios/" class="btn btn-sm btn-outline-secondary btn-nav-forload">              
                Novo benefício
            </a>
        </div>
    </div>
           
    <br/>
    
    <div class="row">
        <div class="col-lg-12">           
            <?php if ($_SESSION['nvBeneficioCadastrado']): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Novo beneficio cadastrado.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>           
        </div>
    </div>
   
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach ($listagemBeneficios as $key => $value): ?>
        <div class="col">
            <div class="card shadow-sm">
                
                <div class="text-center">
                    <img src="<?= $value->imgsrcbeneficio ?>" 
                        class="rounded-start" 
                        alt="" 
                        height="120px">
                </div>

                <div class="card-body">
                    <p class="card-text">
                        
                         <?=  substr_replace($value->descricao, " ... ", 20)  ?>
                    </p>
                    <p class="card-text" style="min-height: 40px">                      
                        <small class="text-muted"><?= substr_replace($value->obsadicional, " ... ", 80)  ?></small>
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="#" class="modaldetalhesBeneficio" data-bs-toggle="modal"  data-id="<?= $value->id ?>" data-bs-target="#staticBackdrop" >
                                <span class="badge bg-success">Editar <i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> 
                            </a>
                            
                        </div>
                        <small class="text-muted">Status.: <?= $value->status ?></small>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    
</main>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">               
                <h5 class="modal-title" id="staticBackdropLabel">Detalhes do Benefício</h5>               
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body detalhesbeneficio">

            </div>
        </div>
    </div>
</div>

<script src="<?php bloginfo('template_url') ?>/ajax/painelempresa-pontosEbeneficios.js"></script>  

<?php get_footer('painel'); ?>
