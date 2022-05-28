<?php

/* Template Name: Painel Empresa - Estorno Resgates */ 

$_SESSION['url_referencia'] = 'painel-empresa-estorno-resgate';

if(!isset($_SESSION['login_painel'])):
    $url = get_bloginfo('url')."/login-painel-empresa/";
    header("Location:$url");
    exit("Sessão expirada ou invalida");
endif; 

get_header('painelcliente');

include( get_template_directory() . '/models/model_solicitacao_resgate.php' );
include( get_template_directory() . '/models/model_estorno_movimento.php' );

if (isset($_POST['flestornar']) || $_POST['flestornar'] == 'sim' ):
    estornarSolicitarResgate($_POST['idResgate']);
    estornarMovimentoRetidaBrinde($_POST['idResgate']);
endif;

$cnpjempresa = $_SESSION['dados_empresa'][0]->cnpj; 
$solitacaoResgate = listarSolicitacaoRestageEmpresa($cnpjempresa);


?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3">    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">
           Cancelar Solicitações e Resgates <small></small>
        </h2>
    </div>
<div class="row mt-5">   
    
    <?php 
        /*
        echo "<pre>";
        var_dump($solitacaoResgate ); 
        echo "</pre>";
        */
    ?>

        <div class="col-lg-12 mt-5">
            <table id="example" class="table table-hover" >               
                <thead>
                    <tr>
                         <th>Cliente</th>
                        <th>CPF</th>
                        <th>Brinde</th>
                        <th>Vencimento</th>
                        <th>Status</th>
                        <th>Cancelar</th>
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

                    <?php if ($value->status == 'estornado'): ?>                    
                        <tr class="text-warning">                   
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
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>                            
                        </td>
                    </tr>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $value->idresgate ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Estorno de Resgates</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body detalhesbeneficio">  
                                                                       
                                    <div class="row">                                            
                                        <form method="post" action="" id="formEstornoResgateBrinde<?= $value->idresgate ?>" ></form>

                                        <input type="hidden" name="flestornar" value="sim"  form="formEstornoResgateBrinde<?= $value->idresgate ?>"/>                                       
                                        <input type="hidden" name="idResgate"  form="formEstornoResgateBrinde<?= $value->idresgate ?>" value="<?= $value->idresgate ?>">
                                        <input type="hidden" name="cpfcliente" form="formEstornoResgateBrinde<?= $value->idresgate ?>" value="<?= $value->cpfcliente ?>">
                                        <input type="hidden" name="qtdpontos"  form="formEstornoResgateBrinde<?= $value->idresgate ?>" value="<?= $value->qtdpontos ?>">
                                        <input type="hidden" name="nomeCliente"  form="formEstornoResgateBrinde<?= $value->idresgate ?>" value="<?= $value->nome_completo ?>">
                                        <div class="col-lg-12">
                                            <p>Cliente.:</p>
                                            <h3 style="margin-top: -12px"><?= $value->nome_completo ?></h3>
                                        </div>
                                        <div class="col-lg-6">
                                            <img src="<?= $value->src_selfie ?>" class="img-thumbnail" width="200px">
                                        </div>
                                        
                                        
                                        <?php if (limitePara24hEstorno($value->dtsolicitacao)): ?>
                                        
                                            <div class="col-lg-6">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Data da solicitação.: <?= date("d/m/Y ",strtotime($value->dtsolicitacao)) ?></li>
                                                    <li class="list-group-item">Item.: <?= $value->descricao ?> </li>
                                                    <li class="list-group-item">Status.: <?= ucfirst($value->status) ?> </li>
                                                </ul>
                                                <?php if ($value->status != 'estornado'): ?>
                                                <hr/>
                                                <p style="font-size: 19px; margin-top: 15px">Tem certeza que deseja estornar ?</p>
                                                <div class="d-grid gap-2">
                                                      <button form="formEstornoResgateBrinde<?= $value->idresgate ?>" class="btn btn-danger" type="submit">Sim, estornar solicitação</button>
                                                </div>
                                                <?php endif; ?>
                                            </div> 
                                        
                                        
                                        <?php else: ?>
                                        <div class="col-lg-6">
                                            
                                            <div class="alert alert-danger" role="alert">
                                                Tempo Limite para estorno excedido
                                            </div>
                                            
                                        </div>
                                        
                                        <?php endif; ?>
                                        
                                                                                                                    
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

       
                      
    <br/>

</main>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Solicitações e Resgates</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body estornoMovimento">
                
            </div>
           
        </div>
    </div>
</div>

<?php get_footer('painel'); ?>

<script>    
    $(document).ready(function() {
         $('#example').dataTable( {
            "order": []
        } );
    } );
</script>


