<?php 
    /* Template Name: Empresa Fidelidade */
    get_header('site');
    $empresa = (get_query_var('slug_empresa'));   
    require './wp-content/themes/fidelidade/inc/functions_cliente.php';
    global $wpdb;
    $result  = $wpdb->get_results("SELECT * FROM empresas where slug_empresa = '$empresa' ");
?>

<br/><br/>

<div class="container">
    
    <?php // var_dump($result); ?>
    
    <div class="row">
        
        <?php if (!$result) : ?> 
        <div class="col-lg-12">     
            <h1>Ops, <small>Fidelidade Web não encontrado</small></h1>  
            <br/>
        </div>
        
        <div class="col-lg-8"> 
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0">Cartão Fidelidade <small>Web</small></h3>
                    
                    <br/>                    
                    <div class="mb-1 text-muted text-small" style="font-size: 13px"> <i class="fa fa-check-circle" aria-hidden="true"></i> Fácil de marcar.</div>
                    <div class="mb-1 text-muted text-small" style="font-size: 13px"> <i class="fa fa-check-circle" aria-hidden="true"></i> Simples de gerenciar.</div>
                    <div class="mb-1 text-muted text-small" style="font-size: 13px"> <i class="fa fa-check-circle" aria-hidden="true"></i> Brindes e CashBack.</div>
                    <div class="mb-1 text-muted text-small" style="font-size: 13px"> <i class="fa fa-check-circle" aria-hidden="true"></i> Controle de Fidelização</div>
                    <br/>
                    <a href="#" class="btn btn-outline-secondary">Saiba mais</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text></svg>
                </div>
            </div>
            </div>  
        <?php endif; ?>
       
        <?php if ($result) : ?>
        
            <div class="col-lg-12">     
                <h1>Fidelidade Web <small> <?=  $result[0]->nome_fantasia ?> </small></h1>
                <h4 class="mb-0"><small>CNPJ.: <?= $result[0]->cnpj ?></small></h4>
                <br/>
            </div>

            <div class="col-lg-8"> 
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">Marcar no cartão web</strong>
                        <h3 class="mb-0">CPF</h3>
                        <div class="mb-1 text-muted">Data de marcação: <?php echo date('d/m/Y') ?></div>
                        <div class="form-group">
                            <input type="text" class="form-control" >
                        </div>
                                       
                        <a href="#" class="btn btn-outline-secondary">Continuar marcação</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text></svg>
                    </div>
                </div>
            </div>
        
        <div class="col-lg-4"> 
            <div class="list-group">
                <button type="button" class="list-group-item list-group-item-action active">
                    Mais Ações
                </button>
                <a href="<?= get_bloginfo('url') ?>/login/?cnpj_emp=<?= $result[0]->cnpj ?>" class="list-group-item list-group-item-action">Painel Admin</a>
                <button type="button" class="list-group-item list-group-item-action">Novo Cliente</button>
                
                <button type="button" class="list-group-item list-group-item-action">Ajuda</button>
                <button type="button" class="list-group-item list-group-item-action" disabled>QR Code</button>
</div>
            </div>
        <?php endif; ?>            
    </div>    
</div>

<br/><br/><br/><br/>

<hr/>

<?php  get_footer('site'); ?>

