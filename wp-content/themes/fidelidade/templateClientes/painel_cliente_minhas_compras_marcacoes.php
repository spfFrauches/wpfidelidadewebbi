<?php 
/* Template Name: Painel Cliente - Minhas compras e marcações */ 
$_SESSION['url_referencia'] = '';
if (isset($_SESSION['login_painel']) && $_SESSION['login_painel'] == 'cliente') :
    get_header('painel');
    include( get_template_directory() . '/models/model_marcacao.php' ); 
    include( get_template_directory() . '/models/model_empresa.php' ); 
        
?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Meu Fidelidade Web</h1>
            
        </div>       
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-secondary rounded shadow-sm">
            <!-- <img class="mr-3" src="" alt="" width="48" height="48"> -->
            <div class="lh-100"> 
              <h6 class="mb-0 text-white lh-100">Olá, <?= $_SESSION['dados_cliente'][0]->nome_completo ?></h6>
              <small>Since 2020</small>
            </div>
        </div>
               
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">Minhas compras e marcações</h6>  
            
            <?php            
               $listarMarcacoes = listarMarcacaoClienteIndividual($_SESSION['dados_cliente'][0]->cpf);
               //var_dump($listarMarcacoes);        
            ?>
            <?php foreach ($listarMarcacoes as $key => $value): ?>
            <div class="media text-muted pt-3" >          
                <svg style="margin-top: 5px" class="bd-placeholder-img mr-2 rounded" width="42" height="42" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <strong class="text-gray-dark">Valor compra R$.: <?= $value->valormarcacao ?></strong>
                        <a href="#">Detalhes</a>
                    </div>
                                    
                    <?php  
                        $cnpj = $value->cnpjemp ;
                        $nomeEmpresa = buscarEmpresa($cnpj);
                        $nomeEmpresa = $nomeEmpresa[0]->nome_fantasia;
                    ?>
                    
                    <span class="d-block">Empresa .: <?php echo "$nomeEmpresa - cnpj - ". $value->cnpjemp ?> </span>
                    <span class="d-block">Data .: <?= date("d/m/Y H:i", strtotime($value->datamarcacao)) ; ?> </span>
                </div>
            </div>
            <?php endforeach; ?>
            
            <small class="d-block text-right mt-3">
                 <a href="#">Avançado</a>
            </small>
        </div>
    </main>

<?php 
    else : 
        $url = get_bloginfo('url')."/login";
        echo "<script>";
        echo "window.location.href = '$url'";
        echo "</script>"; 
     endif;
?>

<?php get_footer('painel') ?>




