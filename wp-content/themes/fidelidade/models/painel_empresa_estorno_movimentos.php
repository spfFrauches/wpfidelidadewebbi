<?php

/* Template Name: Painel Empresa - Estorno Movimentos */ 
if ($_SESSION['login_painel'] != 'empresa'):
    $url = get_bloginfo('url')."/login";
    header("Location:$url");
    exit("A sessão foi expirada ou é invalida");
endif; 

include( get_template_directory() . '/models/model_estorno_movimento.php' );

if (isset($_POST['estornar']) && $_POST['estornar']=='sim'):            
    $estorno = estornarMovimento($_POST['idmarcacao'], $_POST['obsestorno']);
endif;

$cnpjemp = $_SESSION['dados_empresa'][0]->cnpj;
$listarClientes = listarMovimentosClientes($cnpjemp);

get_header('painelcliente');

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3">
      
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">
            Estorno de Marcações <small></small>
        </h2>
    </div>
       
    <?php if (isset($estorno)): ?>
        <div class="alert alert-success" role="alert">
            Estorno realizado com sucesso!
        </div>
    <?php endif; ?>
    
    <?php
    
        echo "<pre>";
        var_dump($listarClientes) ;
        echo "</pre>";
    
    ?>
    
    <div class="row">     
        <div class="col-lg-12">                  
            <div class="row mt-5">   
                <div class="col-lg-12">
                    <table id="example" class="table table-hover" >
                        
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>CPF</th>
                                <th>Data marc.</th>
                                <th>Movimento</th>
                                <th>Valor</th>
                                <th>Ver</th>
                            </tr>
                        </thead> 
                        
                        <tbody>
                            <?php foreach ($listarClientes as $key => $value):?> 
                            <tr>
                                <td>
                                    <?= strtoupper($value->nome_completo) ?>
                                </td>
                                <td>
                                    <?= $value->cpfcli ?>
                                </td>
                                <td>
                                    <?= date('d/m/Y H:i:s', strtotime($value->datamarcacao)) ?>
                                </td>
                                <td>
                                    <?php 
                                    
                                        if ($value->tipomarcacao == 'cash'):
                                            echo "Adionado pontos";
                                        endif;
                                        
                                        if ($value->tipomarcacao == 'retirada'):
                                            echo "Resgate Pontos";
                                        endif;
                                    
                                    ?>
                                </td>
                                <td>
                                    
                                    <?php 
                                    
                                        if ($value->tipomarcacao == 'cash'):
                                            echo $value->valormarcacao ;
                                        endif;
                                        
                                        if ($value->tipomarcacao == 'retirada'):
                                            echo $value->pontos;
                                        endif;
                                    
                                    ?>

                                </td>
                                <td>
                                    <?php if($value->estorno == 's'): ?>
                                    <a href="#" 
                                       class="estorno-movimento text-danger"  
                                       data-bs-toggle="modal" 
                                       data-bs-target="#staticBackdrop" 
                                       data-id="<?= $value->id ?>" 
                                       data-modal="<?= $value->cpfcli ?>">
                                        estornado
                                    </a>

                                    <?php else: ?>
                                    <a href="#" 
                                       class="estorno-movimento"  
                                       data-bs-toggle="modal" 
                                       data-bs-target="#staticBackdrop" 
                                       data-id="<?= $value->id ?>" 
                                       data-modal="<?= $value->cpfcli ?>">
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                    <?php endif; ?>
                                    
                                </td>
                            </tr>
                            <?php endforeach;  ?> 
                        </tbody>  
                        
                    </table>
                </div> 
            </div>            
        </div>
    </div>
    
    <?php
    /*
        echo "<pre>";
        var_dump($listarClientes);
        echo "</pre>";
    */
    ?>
                          
    <br/>

</main>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Estorno de Movimento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body estornoMovimento">
                
            </div>
           
        </div>
    </div>
</div>

<script>    
    $(document).ready(function() {
         $('#example').dataTable( {
            "order": []
        } );
    } );
</script>
<script src="<?php bloginfo('template_url') ?>/ajax/ajax_estorno_movimentos.js"></script>
<?php get_footer('painel'); ?>


