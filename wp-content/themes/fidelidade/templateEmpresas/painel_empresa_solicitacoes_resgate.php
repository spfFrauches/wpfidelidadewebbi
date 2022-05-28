<?php 

/* Template Name: Painel Empresa - Solicitações Resgate */ 
$_SESSION['url_referencia'] = 'painel-empresa-resgate-pontos';
get_header('painelcliente');

include( get_template_directory() . '/models/model_solicitacao_resgate.php' );
include( get_template_directory() . '/models/model_marcacao.php' );

$cnpjempresa = $_SESSION['dados_empresa'][0]->cnpj; 
$_SESSION['nvBeneficioCadastrado'] = false;

if(!isset($_SESSION['login_painel'])):
    $url = get_bloginfo('url')."/login";
    header("Location:$url");
    exit("Sessão expirada ou invalida");
endif; 

$solitacaoResgate = listarSolicitacaoRestageEmpresaApenasSolicitado($cnpjempresa);

if (isset($_POST['filtroStatus'])):
    if ($_POST['filtroStatus'] == 'solicitado'){
        $solitacaoResgate = listarSolicitacaoRestageEmpresaApenasSolicitado($cnpjempresa);
    }
    if ($_POST['filtroStatus'] == 'entregue'){
        $solitacaoResgate = listarSolicitacaoRestageEmpresaApenasEntregue($cnpjempresa);
    }
    if ($_POST['filtroStatus'] == 'estornado'){
        $solitacaoResgate = listarSolicitacaoRestageEmpresaApenasEstornado($cnpjempresa);
    }
    if ($_POST['filtroStatus'] == 'todos') {
        $solitacaoResgate = listarSolicitacaoRestageEmpresa($cnpjempresa);
    }
endif;

if (isset($_POST['idResgate'])):
    $baixa1 = baixaSolicitacaoResgate($_POST['idResgate']);
    if ($baixa1):
        $baixa2 = descontarSaldo_ResgateBeneficio($_POST['qtdpontos'], $_POST['cpfcliente'], $cnpjempresa, $_POST['idResgate']);
        $nomeCliente = $_POST['nomeCliente'];
    endif;
    $solitacaoResgate = listarSolicitacaoRestageEmpresa($cnpjempresa);
endif;
           
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3"> 
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">              
        <h2 class="h2">
            Solicitações de Resgate<small></small>
        </h2>       
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= get_bloginfo('url') ?>/painel-empresa" class="btn btn-sm btn-outline-secondary btn-nav-forload">              
                Voltar
            </a>
        </div>        
    </div> 
    
    <br/> 
    
    <?php   
    
        /*
        echo "<pre>";
        var_dump($solitacaoResgate); 
        echo "</pre>";
        echo "<pre>";
        var_dump($baixa1); 
        echo "</pre>";

        echo "<pre>";
        var_dump($baixa2); 
        echo "</pre>";  
        */  
    ?>
    
   
    <div class="row mt-3">   
        <div class="col-lg-12">         
            <?php if ($baixa2): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Brinde entregue </strong> para o cliente.: <?= isset($nomeCliente) ? "$nomeCliente" : "" ?>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <form class="row g-3" action="" id="formFiltros" method="POST" style="margin-top: -50px">
          <p style="margin-bottom:-5px">Filtro por Status</p>
          <div class="col-auto">
                <select class="form-select" name="filtroStatus">
                    <option value="solicitado" >Solicitados</option>
                    <option value="entregue" <?= isset($_POST['filtroStatus']) && $_POST['filtroStatus'] == 'entregue' ? "selected" : "" ?> >Entregues</option>
                    <option value="estornado" <?= isset($_POST['filtroStatus']) && $_POST['filtroStatus'] == 'estornado' ? "selected" : "" ?> >Estornados</option>
                    <option value="todos" <?= isset($_POST['filtroStatus']) && $_POST['filtroStatus'] == 'todos' ? "selected" : "" ?> >Todos</option>
                </select>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Pesquisar</button>
          </div>
    </form>

        
    <div class="row mt-5">   
        <div class="col-lg-12">
            <table id="example" class="table table-hover" >             
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>CPF</th>
                        <th>Brinde</th>
                        <th>Vencimento</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>               
                <tbody>                    
                    <?php if(!$solitacaoResgate): ?>
                    <tr>
                        <td>Nenhum resgate solicitado</td>
                        <td></td>
                        <td></td>
                        <td></td> 
                        <td></td> 
                    </tr>
                    
                    <?php else: ?>
                    
                    <?php foreach ($solitacaoResgate as $key => $value):?> 
                    
                    <?php if ($value->status == 'vencido'): ?>                    
                        <tr class="text-danger">                   
                    <?php endif; ?>
                    <?php if ($value->status == 'entregue'): ?>                    
                        <tr class="text-success">                   
                    <?php endif; ?>
                    
                        <td><?= strtoupper($value->nome_completo) ?></td>
                        <td><?= $value->cpfcliente ?></td>
                        <td><?= $value->descricao ?></td>
                        <td>
                            <?php if ($value->dtvencimento > '2099-01-01'): ?>
                                Não expira
                            <?php else: ?>
                                <?= date("d/m/Y" , strtotime($value->dtvencimento)) ?>
                            <?php endif; ?>
                            
                        </td>
                        <td><?= ucfirst($value->status) ?></td>
                        <td>                           
                            <a href="#" class="modalResgateBeneficio"  data-bs-toggle="modal" data-bs-target="#exampleModal<?= $value->idresgate ?>" data-cpf="" >
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </a>                            
                        </td>
                    </tr>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $value->idresgate ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Baixa Resgate de brindes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body detalhesbeneficio">  
                                                                       
                                    <div class="row">                                            
                                        <form method="post" action="" id="formBaixaResgateBrinde<?= $value->idresgate ?>" ></form>                                        
                                        <input type="hidden" name="idResgate"  form="formBaixaResgateBrinde<?= $value->idresgate ?>" value="<?= $value->idresgate ?>">
                                        <input type="hidden" name="cpfcliente" form="formBaixaResgateBrinde<?= $value->idresgate ?>" value="<?= $value->cpfcliente ?>">
                                        <input type="hidden" name="qtdpontos"  form="formBaixaResgateBrinde<?= $value->idresgate ?>" value="<?= $value->qtdpontos ?>">
                                        <input type="hidden" name="nomeCliente"  form="formBaixaResgateBrinde<?= $value->idresgate ?>" value="<?= $value->nome_completo ?>">
                                        <div class="col-lg-12">
                                            <p>Cliente.:</p>
                                            <h3 style="margin-top: -12px"><?= $value->nome_completo ?></h3>
                                        </div>
                                        <div class="col-lg-6">
                                            <img src="<?= $value->src_selfie ?>" class="img-thumbnail" width="200px">
                                        </div>
                                                                                
                                        <div class="col-lg-6">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Data da solicitação.: <?= date("d/m/Y ",strtotime($value->dtsolicitacao)) ?></li>
                                                <li class="list-group-item">Item.: <?= $value->descricao ?> </li>
                                            </ul>
                                            <?php if ($value->status == 'solicitado'): ?>
                                            <div class="d-grid gap-2">
                                                  <button form="formBaixaResgateBrinde<?= $value->idresgate ?>" class="btn btn-primary" type="submit">Concluir resgate</button>
                                            </div>
                                            <?php else: ?>
                                            <hr/>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Status.: <?= ucfirst($value->status) ?> </li>
                                            </ul>
                                             <?php endif; ?>
                                        </div> 
                                                                                
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                    </div>                   
                    <?php endforeach;  ?> 
                    <?php endif; ?>
                </tbody>              
            </table>
        </div> 
    </div>      
</main>

<?php get_footer('painel'); ?>

<script src="<?php bloginfo('template_url') ?>/ajax/painelempresa-resgateBeneficios.js"> </script>

<script>
    
    $(document).ready(function() {
        $('#example').dataTable( {
            "order": []
        } );
    } );
   
    
</script>
