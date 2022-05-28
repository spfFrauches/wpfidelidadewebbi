<?php

    require '../../../../wp-load.php';
    include( get_template_directory() . '/models/model_beneficio.php' ); 
    include( get_template_directory() . '/models/model_marcacao.php' );   
    include( get_template_directory() . '/models/model_solicitacao_resgate.php' );
    
    $beneficioPorEmpresa = listarBeneficiosPorEmpresaViaCliente($_POST['cnpjemp']);
      
    $empresa = $_POST['cnpjemp'];
    $cliente = $_SESSION['dados_cliente'][0]->cpf;
    $listarMarcacoesExtrato = listarMarcacaoEmpresaCliente2($_SESSION['dados_cliente'][0]->cpf, $_REQUEST["cnpjemp"]); 
    $totalPontos = 0;
    $totalPontosExpira = 0;

    $sqlConfigEmpresa = "SELECT  * FROM empresa_config  WHERE cnpjemp = '$empresa' ";
    $resutadoConfiguracaoEmpresa = $wpdb->get_results( $sqlConfigEmpresa );
   
    if (!$beneficioPorEmpresa):
        echo '<div class="alert alert-danger" role="alert">';
        echo "<p>Estas empresa esta sem beneficios cadastrados...</p>";
        echo "</div>";
    endif;
          
   foreach ($listarMarcacoesExtrato as $key => $value1 ):  
        if ( $value1->data_expiracao >= date('Y-m-d')   || $value1->data_expiracao == null ):
            $totalPontosCima = $totalPontosCima + ($value1->pontos * $resutadoConfiguracaoEmpresa[0]->vlrSimuladorMoedaApp) ;
        endif;                          
    endforeach;

    foreach ($listarMarcacoesExtrato as $key => $value2):  
        if ( $value2->data_expiracao < date('Y-m-d') && $value2->tipomarcacao != 'retirada' ):
            $totalPontosExpirado = $totalPontosExpirado + $value2->pontos;
        endif;
    endforeach;

    foreach ($listarMarcacoesExtrato as $key => $value3):  
        if (  $value3->estorno == 's'  ):
            $totalPontosEstornado = $totalPontosEstornado + $value3->pontos;
        endif;
    endforeach;

    $totalPontosEstornado = $totalPontosEstornado  * $resutadoConfiguracaoEmpresa[0]->vlrSimuladorMoedaApp;
    $totalPontosCima = $totalPontosCima - $totalPontosEstornado;   
    $solicitacaoRestagateCheck = listarSolicitacaoRestageConfere2($cliente, $empresa)
    
?>

<div class="row mb-2">
    <div class="col-lg-12">       
        <ol class="list-group">
            <li style="font-size: 20px" class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    Meus Pontos
                </div>
              <span class="badge bg-success rounded-pill">R$ <?= $totalPontosCima ?></span>
            </li>           
        </ol>      
    </div>
</div>

<?php
    /*
    echo "<pre>";
    var_dump($listarMarcacoesExtrato); 
    echo "</pre>";
    */
?>
   
<div id="carouselExampleControls" class="carousel slide carousel-dark" data-bs-ride="carousel" >
      
    <div class="row" >
        <div class="col-lg-12">
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="color: #000"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    
    <div class="row text-center" >
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="carousel-inner" style="//background-color: #ced4da" >       
                <?php foreach ($beneficioPorEmpresa as $key => $value): ?>        
                <?php $solicitacaoResgate = listarSolicitacaoRestageConfere($cliente, $value->id); ?>
                <div class="carousel-item <?= $key == 0 ? "active": "" ?>" >     
                    <?php if (!empty($solicitacaoRestagateCheck)): ?>
                    <div class="row">                
                        <div class="col-lg-12">           
                            <div class="alert alert-warning" role="alert">
                                Já existe uma solicitação de resgate em andamento. 
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>           
                    <div class="row ">                
                        <div class="col-lg-12">
                            <img 
                                class="img-resolut" 
                                src="<?= $value->imgsrcbeneficio ?>" 
                                style="display: block;margin-left: auto;margin-right: auto;"
                                >
                        </div> 
                    </div>           
                    <div class="row">     
                        <div class="col-lg-12 pe-5 px-5 mt-3">
                            <?php if (!empty($solicitacaoResgate)): ?>
                                <span class="badge rounded-pill bg-warning text-dark">Item solicitado para Resgate</span>                   
                            <?php endif; ?>

                            <ol class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        Cód.:<?= $value->id ?> 
                                        <div class="fw-bold"><?= $value->descricao ?></div>
                                        <div style="font-size: 12px; color: #606060 "><?= $value->obsadicional ?></div>
                                    </div>
                                  <span class="badge bg-primary rounded-pill"></span>
                                </li>                       
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Valor em Pontos.:</div>

                                    </div>
                                  <span class="badge bg-primary rounded-pill"><?= $value->qtdpontos * ($resutadoConfiguracaoEmpresa[0]->vlrSimuladorMoedaApp) ?></span>
                                </li>  
                            </ol>
                        </div>
                    </div>           
                    <?php if ( $totalPontosCima < $value->qtdpontos  * ($resutadoConfiguracaoEmpresa[0]->vlrSimuladorMoedaApp) )  : ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Saldo insuficiente
                    </div>
                    <?php endif; ?>

                    <?php if ($totalPontosCima >= $value->qtdpontos * ($resutadoConfiguracaoEmpresa[0]->vlrSimuladorMoedaApp) ): ?>

                    <!-- http://restaurantemegachic.com/fidelidade/painel-cliente-concluir-solicitacao-resgate/ -->
                    <form action="<?= get_bloginfo('url') ?>/painel-cliente-concluir-solicitacao-resgate" method="POST" id="formSolicitacaoRestate<?= $value->id ?>" ></form>

                    <div class="row mt-5">     
                        <div class="col-lg-12">
                            <div class="d-grid gap-2">
                                <input type="hidden" form="formSolicitacaoRestate<?= $value->id ?>"  name="cnpjemp" value="<?= $empresa ?>" />
                                <input type="hidden" form="formSolicitacaoRestate<?= $value->id ?>"  name="cpfcliente" value="<?= $cliente ?>" />
                                <input type="hidden" form="formSolicitacaoRestate<?= $value->id ?>"  name="cdbeneficio" value="<?= $value->id ?>" />
                                <input type="hidden" form="formSolicitacaoRestate<?= $value->id ?>"  name="dtsolicitacao" value="<?= date("Y-m-d H:i"); ?>" />
                                <input type="hidden" form="formSolicitacaoRestate<?= $value->id ?>"  name="status" value="solicitado"/>
                                <input type="hidden" form="formSolicitacaoRestate<?= $value->id ?>"  name="solicitacao_resgate" value="true"/>                        
                                <?php if (empty($solicitacaoRestagateCheck)): ?>
                                <button 
                                    type="submit" 
                                    form="formSolicitacaoRestate<?= $value->id ?>" 
                                    class="btn btn-primary btnSolicitarResgate btn-load-solicitarRestage" 
                                    type="button" <?= !empty($solicitacaoResgate) ? "disabled" : ""  ?>>
                                    <?= !empty($solicitacaoResgate) ? "Resgate já solicitado" : "Solicitar Resgate"  ?>
                                </button>
                                <?php endif; ?>

                                <?php if (!empty($solicitacaoRestagateCheck)): ?>
                                <button 
                                    type="submit" 
                                    form="formSolicitacaoRestate<?= $value->id ?>" 
                                    class="btn btn-primary btn-load-solicitarRestage" 
                                    data-bs-toggle="modal" data-bs-target="#modalLoad"
                                    type="button" 
                                    disabled>
                                    Solicitar resgate
                                </button> 
                                <?php endif; ?>                      
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>         
                </div> 
                <?php endforeach; ?>       
            </div>
        </div>  
        <div class="col-lg-2"></div>
    </div>    
</div>


<br/><br/><br/>
                       

