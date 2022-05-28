<?php 
/* Template Name: Painel Empresa - Cadastro Beneficios */ 
get_header('painel');

$_SESSION['nvBeneficioCadastrado'] = false;

include( get_template_directory() . '/models/model_beneficio.php' );
include( get_template_directory() . '/inc/include_helper_validaPOST_CadastroBeneficio.php' ); 

if(!isset($_SESSION['login_painel'])):
    $url = get_bloginfo('url')."/login";
    header("Location:$url");
    exit("Sessão expirada ou invalida");
endif; 

$_SESSION['url_referencia'] = 'empresa-beneficios-por-pontos';
$caminhoImgDefault = get_bloginfo('template_url')."/img/beneficio-logo2.png"; 

if (isset($_POST)):
    if (recebeDadosPostCadastroBeneficio()):
        $_SESSION['nvBeneficioCadastrado'] = true;
        $urlRedirect = get_bloginfo('url').'/painel-empresa/beneficios-por-pontos/';
        echo "<script>";
        echo  "window.location.href = '$urlRedirect' ";;
        echo "</script>";
    endif;
endif;
            
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3">
      
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Cadastro de benefícios <small></small></h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= get_bloginfo('url') ?>/painel-empresa/beneficios-por-pontos/" class="btn btn-sm btn-outline-secondary btn-nav-forload">              
                Voltar
            </a>
        </div>
    </div>
           
    <br/>
    
    <form action="" method="post" enctype="multipart/form-data" >
    
        <div class="row">
            <div class="col-lg-2">
                <img id="previewImg" class="img-thumbnail" width="150" src="<?= $caminhoImgDefault ?>" alt="imagem ilustrativa do beneficio">       
            </div>
            <div class="col-lg-4 mt-5">
                <label for="formFileSm" class="form-label" style="font-size: 17px">Imagem ilustrativa do brinde / beneficio</label>
                <br/>
                <input class="form-control form-control-sm imgBrinde" id="formFileSm"  type="file" name="imgbeneficio"  onchange="previewFile(this);"  accept="image/*" required>
            </div>
        </div>

        <input type="hidden" class="form-control" name="cnpjemp" value="<?= $_SESSION['dados_empresa'][0]->cnpj ?>">

        <div class="row mt-5">
            <div class="col-lg-6 mt-3">
                <label class="form-label">Descrição do Beneficio</label>
                <input type="text" class="form-control" name="descricaobeneficio" required>
            </div>
            <div class="col-lg-6 mt-3">
                <label class="form-label">Valor em Pontos</label>
                <input type="text" class="form-control dinheiro" name="valorpontos" required>
            </div>
            
            <!--
            <div class="col-lg-6 mt-3">
                <label class="form-label">Data de Validade</label>
                <input type="date" class="form-control" name="dtvalidade" >
            </div>
            -->
            
            <div class="col-lg-6 mt-3">
                <label class="form-label">Status</label>
                <select class="form-select" aria-label=".form-select-sm example" name="status" id="status">
                    <option value="ativo" selected>Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12">
                <label class="form-label">Observação adicional do Beneficio</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="obsadicional" rows="3" required ></textarea>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-nav-forload" type="submit">Salvar</button>
                </div>
            </div>
        </div>
    
    </form>
       
</main>

    
<?php get_footer('painel'); ?>

<script>
    
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
    
    $('.dinheiro').mask('#.##0,00', {reverse: true});
    
    var formFileSm = $('.imgBrinde');
    
    $('.btn-nav-forload').click(function() {
        console.log(formFileSm.length);
    });
    
    
    
    
</script>  
