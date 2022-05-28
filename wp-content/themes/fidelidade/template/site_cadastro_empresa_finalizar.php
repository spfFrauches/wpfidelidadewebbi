<?php 

/* Template Name: Site Finalizar Cadastro Empresa */ 
$_SESSION['url_referencia'] = '';
get_header('sitetmpl4');

include( get_template_directory() . '/functions/functions_empresa.php' ); 
include( get_template_directory() . '/models/model_empresa.php' ); 
include( get_template_directory() . '/inc/include_helper_validaPOST_CadastroEmpresaSite.php' ); 
              
?>

<?php if ($result): ?>

<br/><br/><br/>

<div class="container">       
    <div class="py-5 text-center mt-5">
        <img 
            class="d-block 
            mx-auto mb-4" 
            src="<?= get_bloginfo('template_url') ?>/img/sucess_01.png" alt="" 
            width="72" height="72">
        <h2>Parabéns, seu cadastro foi realizado.</h2>
        <p class="lead">
            Vamos inserir aqui uma mensagem informado as próximas etapas 
            para usar a ferramenta .
        </p>
        <br/>
        <a href="<?= get_bloginfo('url') ?>/login-painel-empresa/" class="btn btn-outline-primary" >Entrar</a>  
    </div>   
</div>

<br/><br/><br/>


<?php else : ?>

<br/><br/><br/>

<div class="container"> 
    <div class="py-5 text-center mt-5 mb-5">
        <img class="d-block mx-auto mb-4" src="<?= get_bloginfo('template_url') ?>/img/error_01.png" alt="" width="72" height="72">
        <h2 style="color:red">Ops! Desculpe, algo errado...</h2>
        
        <?php if ($MgsAlertaCnpj): ?>
        <div class="alert alert-danger" role="alert">
            <?= $MgsAlertaCnpj ?>
        </div>
        <?php endif; ?>
        
        <?php if ($MgsAlertaRazaoSocial): ?>
        <div class="alert alert-danger" role="alert">
            <?= $MgsAlertaRazaoSocial ?>
        </div>
        <?php endif; ?>
        
        <?php if ($MgsAlertaFantasia): ?>
        <div class="alert alert-danger" role="alert">
            <?= $MgsAlertaFantasia ?>
        </div>
        <?php endif; ?>
        
        <?php if ($MgsAlertaEmail): ?>
        <div class="alert alert-danger" role="alert">
            <?= $MgsAlertaEmail ?>
        </div>
        <?php endif; ?>
        
        <?php if ($MgsAlertaTelefone): ?>
        <div class="alert alert-danger" role="alert">
            <?= $MgsAlertaTelefone ?>
        </div>
        <?php endif; ?>
        
        <?php if ($MgsAlertaSenha): ?>
        <div class="alert alert-danger" role="alert">
            <?= $MgsAlertaSenha ?>
        </div>
        <?php endif; ?>
        
        <?php if ($MgsAlertaConfirmarSenha): ?>
        <div class="alert alert-danger" role="alert">
            <?= $MgsAlertaConfirmarSenha ?>
        </div>
        <?php endif; ?>
        
        <?php if ($MgsAlertaCep): ?>
        <div class="alert alert-danger" role="alert">
            <?= $MgsAlertaCep ?>
        </div>
        <?php endif; ?>
        
        <?php if ($MgsAlertaCidade): ?>
        <div class="alert alert-danger" role="alert">
            <?= $MgsAlertaCidade ?>
        </div>
        <?php endif; ?>
        
        <?php if ($MgsAlertaBairro): ?>
        <div class="alert alert-danger" role="alert">
            <?= $MgsAlertaBairro ?>
        </div>
        <?php endif; ?>
        <?php if ($MgsAlertaEndereco): ?>
        <div class="alert alert-danger" role="alert">
            <?= $MgsAlertaEndereco ?>
        </div>
        <?php endif; ?>
            
        <p class="lead" style="color:red">
            Não foi possivel prosseguir com o cadastro. Tente novamente
            observando com cuidado todos os campos do formulário.
        </p>
        <br/>
        <a href="<?= get_bloginfo('url') ?>/nova-empresa" class="btn btn-outline-danger" >Voltar ao cadastro</a>
    </div>   
</div>

<?php endif; ?>

<br/><br/><br/>
<br/><br/><br/>
<br/><br/><br/>

<div class="container">
    <div class="row mt-3 mb-3">
        <div class="col-lg-12">
            
        </div>
    </div>
</div>

<?php get_footer('sitetmpl4'); ?>







