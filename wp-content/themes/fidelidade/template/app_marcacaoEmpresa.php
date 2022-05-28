<?php 
/* Template Name: App -  Marcação cartão */ 
$_SESSION['url_referencia'] = '';
get_header('app'); 
    
    if(!isset($_SESSION['login_painel'])):
        $url = get_bloginfo('url')."/login";
        header("Location:$url");
        exit("Sessão expirada ou invalida");
    endif; 
    
    include( get_template_directory() . '/models/model_empresa_config.php' );
    include( get_template_directory() . '/models/model_empresa.php' );
    
    $caminhoImgDefault = get_bloginfo('template_url')."/img/default-user-1.png";  
    
    $carregarConfiguracaoEmpresa = verConfigMarcacaoEmpresa($_SESSION['dados_empresa'][0]->cnpj);
    $dadosEmpresa = buscarEmpresa($_SESSION['dados_empresa'][0]->cnpj);
    
    $tipoMarcacao = $carregarConfiguracaoEmpresa[0]->tipo_marcacao ;
    $logoEmpresa = $dadosEmpresa[0]->logoempsrc;
        
?>
<style>
    
    @media (max-width:550px){      
        .topo{
            margin-top: -50px;
        }
    }
    
    .mobile-form {
        border:none;
        border-bottom: 1px solid #ccc;        
        border-radius: 0;
        box-shadow: none !important;         
    }
    
</style>
 
<div class="container">     
    <div class="py-3 text-center topo m-2"> 
        
        <?php if (!$tipoMarcacao): ?>
        <div class="alert alert-danger" role="alert">
            O tipo de marcação não foi configurado. Para continuar vá em [Configurações] e defina.
        </div>
        <?php endif; ?>
        
        <br/>
        
        <?php if ($logoEmpresa != ''): ?>
            <img class="d-block mx-auto mb-4" src="<?= $logoEmpresa ?>" alt="" height="102">
        <?php endif; ?>
        <?php if (empty($logoEmpresa)): ?>
            <i class="fa fa-adn fa-5x" aria-hidden="true"></i>    
        <?php endif; ?>
        
        <h2 style="color: #56595c">
            <?= $_SESSION['dados_empresa'][0]->nome_fantasia ?>
        </h2>    
            
        <h5 style="color: #8b8f9a; margin-top: -10px">
            <?= NOME_APLICACAO ?>
        </h5>
            
        <span class="badge rounded-pill bg-dark p-2 mb-5">Marcações</span>  
        
        <br/>
        
        <div class="form-group mt-5" id="load_form_marcacao">
            <div class="spinner-border text-secondary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
               
        <div class="row cpf_form_marcacao">
            <div class="col-3"></div>
            <div class="col-lg-6 mt-4 mb-4">  
                <div class="card p-4">

                    <input 
                    type="text" 
                    class="form-control mobile-form text-center" 
                    size="5" id="cpf_marcacao" 
                    name="cpf_marcacao" 
                    aria-describedby="emailHelp" required="" placeholder="000.000.000-00">
                    <small id="cpfHelp" class="form-text">
                        CPF do cliente
                    </small>                    
                </div>             
            </div>
            <div class="col-3"></div>
        </div>
                
        <div class="row" id="confirma_marcacao">               
            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-6 col-md-6 mt-4 mb-4"> 
                <div class="card p-4">
                    <div class="row text-center">
                        <div class="col-lg-12">                   
                            <img id="selfie" src="<?= $caminhoImgDefault ?>" height="120px" class="rounded" alt="...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="margin-top: 20px">
                            <h4 class="text-center"><small id="confirma_marcacaoNome">Nome do Cliente</small></h4>
                            <h4 class="text-center" style="margin-top: -15px"><small id="confirma_marcacaoCPF">000.000.000-00</small></h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <label  class="col-sm-2 col-2 col-form-label text-end">R$</label>
                        <div class="col-sm-10 col-10 text-start">
                            <input type="text" class="form-control dinheiro mobile-form" id="valorMarcacao" placeholder="00,00"/>
                            <small id="cpfHelp" class="form-text">&nbsp;&nbsp;Informe o valor</small>
                            <input type="hidden" name="tipo_marcacao" id="tipoMarcacao" value="<?= $carregarConfiguracaoEmpresa[0]->tipo_marcacao  ?>"/>
                        </div>     
                    </div>   
                </div>
            </div>
            <div class="col-lg-3 col-md-3"></div>           
        </div>
           
        <div class="form-group card p-2" id="confirma_marcacaoConfere">       
             <div class="row text-center">
                <div class="col-lg-12">
                   <h4>Confirmação de Marcação</h4>
                </div>
            </div>      
            <div class="row text-center mt-2">
                <div class="col-lg-12">
                    <img id="selfie2" src="<?= $caminhoImgDefault ?>" height="120px" class="rounded" >
                </div>
            </div>           
            <div class="row mt-4 mb-4">
                <div class="col-lg-12">
                    <h4 id="confirma_marcacaoNomeConfere"><small>Cliente.:</small> Nome do Cliente</h4>
                    <h4 id="confirma_marcacaoCPFConfere" ><small>CPF.:</small> 000.000.000-00</h4>
                    <h4><small>Valor R$ .: </small><b id="confirma_marcacaoValorConfere">R$ 000,00</b></h4>
                </div>               
            </div>        
        </div>

        <div class="form-group card p-2 mt-5" id="confirma_marcacaoConfereSucesso">
            <div class="row">
                <div class="col-lg-12 text-success">
                    <i class="fa fa-check-circle fa-5x" aria-hidden="true"></i>
                    <br/>
                    <p>
                        Marcação feita com sucesso!
                    </p>
                </div>               
            </div>        
        </div>
        
        <div class="form-group card p-4 mt-5" id="confirma_marcacaoNaoExiste">
            <div class="row">
                <div class="col-lg-12 text-danger" >
                    <i class="fa fa-times fa-5x" aria-hidden="true"></i>         
                    <br/>
                    <p>
                        Desculpe, mas não encotramos registro desse CPF.
                    </p>     
                </div>             
            </div>        
        </div>
        
        <br/><br/>
        
        <div class="row" id="btnsMarcarVoltar">
            
            <div class="col-6">
                <div class="d-grid gap-2">
                    <button type="button" id="btcVoltarMarcacao" class="btn btn-warning btn-lg btn-block text-white">Voltar</button>
                </div>
                <div class="d-grid gap-2">
                    <button type="button" id="btcVoltarMarcacaoConfere" class="btn btn-warning btn-lg btn-block">Voltar e corrigir</button>
                </div>
                <div class="d-grid gap-2">
                    <button type="button" id="btcVoltarVazio" class="btn btn-warning btn-lg btn-block">Voltar</button>
                </div>
            </div>
            
            <div class="col-6"> 
                <div class="d-grid gap-2">
                    <button type="button" id="btcContinuarMarcacao" class="btn btn-info btn-lg btn-block text-white" <?= (!$tipoMarcacao) ? "disabled" : "" ?>>Continuar</button>
                </div>
                <div class="d-grid gap-2">
                    <button type="button" id="btnMarcar" class="btn btn-secondary btn-lg btn-block" style="margin-top: -1px"<?= (!$tipoMarcacao) ? "disabled" : "" ?>>Marcar</button>
                </div>
                <div class="d-grid gap-2">
                    <button type="button" id="btnMarcarConfere" class="btn btn-secondary btn-lg btn-block">Confirmar Marcação</button>
                </div>
            </div>
        </div>

        <div class="row" id="btnNovaMarcacao">
            <div class="col-12">
                <button type="button" id="btnNovaMarcacao" class="btn btn-warning btn-lg btn-block">Nova marcação</button>
            </div>
        </div>
                
    </div>
</div>
    
<?php get_footer('app'); ?>








