<?php 

/* Template Name: Painel Empresas Configuração */ 
$_SESSION['url_referencia'] = '';
get_header('painel');

if ($_SESSION['login_painel'] != 'empresa'):
    $url = get_bloginfo('url')."/login-painel-empresa/";
    header("Location:$url");
    exit("A sessão foi expirada ou é invalida");
endif; 

include( get_template_directory() . '/models/model_marcacao.php' );
setlocale( LC_ALL, 'pt_BR.utf-8', 'pt_BR', 'Portuguese_Brazil');
date_default_timezone_set('America/Bahia');  

require ( get_template_directory() . '/models/model_empresa_config.php' );    
$config = verConfigMarcacaoEmpresa($_SESSION['dados_empresa'][0]->cnpj);
        
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3"> 
    
    <div class="row">            
        <div class="col-lg-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Configurações <?= NOME_APLICACAO ?></h1> 
                <br/>
            </div>
        </div>
    </div>
    
    <?php 
        /*
        echo "<pre>";
        var_dump($config);
        echo "<pre>";
        */
    ?>
    
    <br/>
    <div class="row">     
        <?php            
            if ($config):      
                $tipoMarcacao = $config[0]->tipo_marcacao; 
                if ($config[0]->tipo_marcacao == 'cash' ) {
                    $percentual = $config[0]->percentual_vlrcompra;
                    $tempoExpira = $config[0]->tempoExpirarPontos;
                    $tempoExpiraResgate = $config[0]->tempo_expira_resgate;
                    $tempoEntreMarcacao = $config[0]->tempoEntreMarcacao;
                }
            else
                $tipoMarcacao = 'nada';
            endif;
        ?>    
    </div>
    <div class="row">    
        <div class="col-lg-12">
            <?php if (!$config): ?>
            
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Nenhuma configuraçao aplicada</h4>
                    <p>
                        Configure a forma de pontuação para seus clientes. Sem isso não será possivel
                        continuar.
                    </p>
                    <hr>
                    <p class="mb-0">
                        Defina a quantidade de obtenção de pontos com base na compra dos produtos
                        ou serviços por parte do seu cliente.
                    </p>
                </div>
            
            
            <?php endif; ?>

            <?php if ($config): ?>
                <div class="alert alert-warning" role="alert">
                    <h3>Atenção</h3>
                    <hr>
                    <p>
                        Cuidado ao alterar o percentual, os anterios já marcados não sofrem alteração
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mt-4"> 
        <div class="col-lg-6">
            <div class="form-group">            
                <label class="h5" >Forma de adquirir pontos</label>
                <div class="form-group">
                    <select class="form-select" id="tipoMarcacao" name="tipoMarcacao">
                        <option value="cash" <?= ($tipoMarcacao=='cash') ?  "selected" : "" ?> >Base no valor da compra/pgto</option>
                    </select>
                </div>
            </div>             
        </div> 
        <div class="col-lg-6">          
            <label class="my-1 mr-2">Porcentual (%) de conversão</label>
            <input type="text" class='form-control dinheiro' name="percentual" id='percentual' value="<?= $percentual ?>">
           
            <small id="percentualHelp" class="form-text">Este campo é obrigatório</small>
        </div>  
        <div class="col-lg-6">          
            <label class="my-1 mr-2">Variavel Simulação Moeda</label>
            <input type="text" class='form-control dinheiro' name="percentual" id='percentual' value="<?= $percentual ?>">
           
            <small id="percentualHelp" class="form-text">Este campo é obrigatório</small>
        </div>  
    </div> 
    <br/>
    
    <div class="row"> 
        <div class="col-lg-6">           
            <label class="my-1 mr-2">Tempo expiração pontos</label>
            <div class="input-group mb-3">
                <input type="number" name="tempoExpiracao"  id="tempoExpiracao" class="form-control" value="<?= $tempoExpira ?>"  aria-describedby="basic-addon2" required>
                <span class="input-group-text" id="basic-addon2">Dias</span>              
            </div>
            <small id="percentualHelp" class="form-text">Dias calculados com base na última marcação [0 - não expira]</small>
        </div>       
        <div class="col-lg-6">           
            <label class="my-1 mr-2">Tempo expiração resgates</label>
            <div class="input-group mb-3">
                <input type="number" name="tempoExpiracaoResgate"  id="tempoExpiracaoResgate" class="form-control" value="<?= $tempoExpiraResgate ?>"  aria-describedby="basic-addon2" required>
                <span class="input-group-text" id="basic-addon2">Dias</span>              
            </div>
            <small id="percentualHelp" class="form-text">Dias calculados com base na solicitação resgate [0 - não expira]</small>
        </div>      
    </div>
    
    <div class="row mt-4"> 
        <div class="col-lg-6">           
            <label class="my-1 mr-2">Tempo entre marcações (mesmo cliente)</label>
            <div class="input-group mb-3">
                <input type="number" name="tempoEntreMarcacao"  id="tempoEntreMarcacao" class="form-control" value="<?= $tempoEntreMarcacao ?>"  aria-describedby="basic-addon2" readonly>
                <span class="input-group-text" id="basic-addon2">Horas</span>              
            </div>
            <small id="percentualHelp" class="form-text">Limite de tempo entre marcações do mesmo cliente</small>
        </div>
    </div>
    
    <div class="row  mt-5">
        <div class="col-lg-6">  
            <div class="d-grid gap-2 col-12 mx-auto">
                <?php if ($config): ?>
                <input type="hidden" name="update" id='update' value="sim">
                <?php endif; ?>
                <button  class="btn btn-primary my-1  btn-block btnSalvarAction btn-nav-forload"  >Salvar</button> 
            </div>
        </div>
    </div>
             
    
    <br/>
</main>
<?php 
    get_footer('painel');   
?>
<script src="<?php bloginfo('template_url') ?>/ajax/ajax_empresa_config.js"></script>
<script>
$('.dinheiro').mask('#.##0,00', {reverse: true});
</script>


