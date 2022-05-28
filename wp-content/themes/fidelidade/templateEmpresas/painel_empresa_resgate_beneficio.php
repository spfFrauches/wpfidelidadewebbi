<?php 
/* Template Name: Painel Empresa - Resgate Beneficio */ 
$_SESSION['url_referencia'] = 'painel-empresa-resgate-pontos';
get_header('painel');

include( get_template_directory() . '/models/model_beneficio.php' );
include( get_template_directory() . '/models/model_clientes.php' );
include( get_template_directory() . '/models/model_marcacao.php' );

$listarCliente = listarDadosCompletosClientesLigadosCalculandoPontosAtuais($_SESSION['dados_empresa'][0]->cnpj);
$configEmpresa = listarConfiguracaoEmpresa($_SESSION['dados_empresa'][0]->cnpj);   

$percentualDaEmpresa = $configEmpresa[0]->percentual_vlrcompra;
$cnpjempresa = $_SESSION['dados_empresa'][0]->cnpj;
    
$_SESSION['nvBeneficioCadastrado'] = false;

if(!isset($_SESSION['login_painel'])):
    $url = get_bloginfo('url')."/login";
    header("Location:$url");
    exit("Sessão expirada ou invalida");
endif; 

$brindePontosMinimos = brindeMenorPonto($_SESSION['dados_empresa'][0]->cnpj);
           
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3">
      
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Pontos de Clientes <small></small></h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= get_bloginfo('url') ?>/painel-empresa" class="btn btn-sm btn-outline-secondary btn-nav-forload">              
                Voltar
            </a>
        </div>
    </div>
        
    <br/>
    
    <div class="row">
        <div class="col-lg-6">         
            <ol class="list-group ">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        Minimo Resgate
                    </div>
                  <span class="badge bg-primary rounded-pill"><?= $brindePontosMinimos[0]->pontosMinimos ?></span>
                </li>                       
            </ol>               
        </div>
    </div>
    
    <div class="row mt-5">   
        <div class="col-lg-12">
            <table id="example" class="table table-hover" >
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>CPF</th>
                        <th>Últ. Marcação</th>
                        <th>Pontos</th>
                        <!--<th>Brinde</th> -->
                    </tr>
                </thead>               
                <tbody>
                    <?php foreach ($listarCliente as $key => $value):?> 
                    <tr>
                        <td><?= strtoupper($value->NOME) ?></td>
                        <td><?= $value->CPF ?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($value->ULTMARC)) ?></td>
                        <td><?= $value->SOMAPONTOS ?></td>
                        <!--
                        <td>                           
                            <a href="#" class="modalResgateBeneficio"  data-bs-toggle="modal" data-bs-target="#exampleModal" data-cpf="<?= $value->CPF ?>" data-modal="<?= $cnpjempresa ?>" data-cnpj="<?= $cnpjempresa ?>" >
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </a>                            
                        </td>
                        -->
                    </tr>
                     <?php endforeach;  ?> 
                </tbody>              
            </table>
        </div> 
    </div>
            
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resgate de brindes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body detalhesbeneficio">
            </div>
        </div>
    </div>
</div>

    
<?php get_footer('painel'); ?>

<script src="<?php bloginfo('template_url') ?>/ajax/painelempresa-resgateBeneficios.js"> </script>

<script>
    
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    
</script>
