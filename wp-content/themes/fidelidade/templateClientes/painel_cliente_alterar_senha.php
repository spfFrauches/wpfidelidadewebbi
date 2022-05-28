<?php 
$_SESSION['url_referencia'] = '';
/* Template Name: Painel Cliente AlterarSenha */ 
get_header('painel');
include( get_template_directory() . '/models/model_clientes.php' );
include( get_template_directory() . '/functions/functions_login.php' );
include( get_template_directory() . '/functions/functions_cliente.php' );

$dadosCliente = buscarClientes($_SESSION['dados_cliente'][0]->cpf);

if ($_SESSION['login_painel'] != 'cliente'):
    $url = get_bloginfo('url')."/login";
    header("Location:$url");
    exit("A sessão foi expirada ou é invalida");
endif; 

if (isset($_POST)):
   $resultAlterarSenha = alterarSenhaDashBoard();  
endif;
     
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
    <div class="d-flex justify-content-between flex-wrap flex-lg-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Alterar Senha</h1>
    </div>
    
    
    
    <form method="post" id="formclientes" action="">  
        
         <?php if ($resultAlterarSenha == "SenhaAlterada"): ?>      
            <div class="alert alert-success" role="alert">
                Sua senha foi alterada com sucesso!
            </div>
        <?php endif; ?>
        
        <?php if ($resultAlterarSenha == "SenhaAtualInvalida"): ?>      
            <div class="alert alert-danger" role="alert">
                A senha atual está incorreta, verifique e tente novamente.
            </div>
        <?php endif; ?>
        
        <?php if ($resultAlterarSenha == "NovasSenhasInvalidas"): ?>      
            <div class="alert alert-danger" role="alert">
                A confirmação de senha não confere, verifique e tente novamente.
            </div>
        <?php endif; ?>
        
      
        
               
        <div class="row">
            <div class="col-lg-6">
                <label>Senha Atual</label>
                <input type="password" class="form-control" name="senhaatual" required >
            </div>
        </div>             
        <div class="row mt-5">    
            <div class="col-lg-6 mb-3">
                <label>Nova Senha </label>
                <input type="password" class="form-control" name="novasenha" id="novasenha" required>
                 <small id="novasenhaHelp" class="form-text">Informe sua nova senha de acesso</small>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>
        </div>
        <div class="row">  
            <div class="col-lg-6 mb-3">
                <label>Confirmar nova Senha</label>
                <input type="password" class="form-control" name="novasenha_confirma"  id="novasenha_confirma" required>
                <small id="novasenhaHelp1" class="form-text">Confirme sua nova senha</small>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>           
        </div>           
        <div class="row">
            <div class="col-lg-4">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-block btnSalvarAlteracaoSenha" type="submit">Salvar</button>
                </div>
            </div>
        </div>    
    </form>
  
</main>


<?php get_footer('painel'); ?>



