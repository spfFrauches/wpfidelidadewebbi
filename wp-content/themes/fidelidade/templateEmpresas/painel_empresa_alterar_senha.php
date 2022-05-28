<?php 
/* Template Name: Painel Empresa - Alterar Senha */ 
$_SESSION['url_referencia'] = '';
get_header('painel');
include( get_template_directory() . '/functions/functions_login.php' ); 
include( get_template_directory() . '/models/model_empresa.php' );
include( get_template_directory() . '/functions/functions_empresa.php' );

if(!isset($_SESSION['login_painel'])):
    $url = get_bloginfo('url')."/login";
    header("Location:$url");
    exit("Sessão expirada ou invalida");
endif; 

$resultAlterarSenha = alterarSenhaDashBoard();
            
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3">
      
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Minha Empresa <small> Alterar Senha</small></h2>
    </div>
    
    <form class="needs-validation" novalidate action="" method="post">
        
        <?php if ($resultAlterarSenha == "SenhaAlterada"): ?>      
            <div class="alert alert-success" role="alert">
                As senhas foram alteradas com sucesso!
            </div>
        <?php endif; ?>
        
        <?php if ($resultAlterarSenha == "SenhaAtualInvalida"): ?>      
            <div class="alert alert-danger" role="alert">
                A senha atual está incorreta, verifique e tente novamente.
            </div>
        <?php endif; ?>
        
        <?php if ($resultAlterarSenha == "NovasSenhasInvalidas"): ?>      
            <div class="alert alert-danger" role="alert">
                As novas senhas informadas não conferem, verifique e tente novamente.
            </div>
        <?php endif; ?>
        
        <br/>
        
        <div class="row">
            <div class="col-lg-6">
                <label>Senha Atual</label>
                <input type="password" class="form-control" name="senhaatual" required >
            </div>
        </div>
        
        <br/>  
        
        <div class="row">    
            <div class="col-lg-6 mb-3">
                <label>Nova Senha </label>
                <input type="password" class="form-control" name="novasenha" id="novasenha" required>
                 <small id="novasenhaHelp" class="form-text">Nova senha da empresa</small>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>
        </div>
        
        <div class="row">  
            <div class="col-lg-6 mb-3">
                <label>Confirmar nova Senha</label>
                <input type="password" class="form-control" name="novasenha_confirma"  id="novasenha_confirma" required>
                <small id="novasenhaHelp1" class="form-text">Confirmação da nova senha</small>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>           
        </div>
            
        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-block btnSalvarNovaSenha" type="submit">Salvar</button>
                </div>
            </div>
        </div>
                
    </form>
    <br/>
    
</main>

<script>
    
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
    })();
    
    var senha =  document.getElementById("novasenha");
    var confirmar_senha = document.getElementById("novasenha_confirma");
    document.getElementById("novasenhaHelp").style.color = "gray";
    document.getElementById("novasenhaHelp1").style.color = "gray";

    confirmar_senha.addEventListener("blur", function() {
    
    console.log(senha.value);
    console.log(confirmar_senha.value);
    
    if (senha.value !== confirmar_senha.value) { 

        senha.style.border = "solid 1px #FF0000"; 
        confirmar_senha.style.border = "solid 1px #FF0000";
        
        var desativar = document.createAttribute("disabled");  
        document.getElementById("btnSalvarNovaSenha").setAttributeNode(desativar);   

        document.getElementById("novasenhaHelp").innerHTML = "As senhas não conferem";
        document.getElementById("novasenha").style.color = "red";
        document.getElementById("novasenhaHelp").style.color = "red"; 
        document.getElementById("novasenhaHelp1").style.color = "red"; 

    } else {
        document.getElementById("novasenhaHelp").innerHTML = "Nova senha da empresa";
        document.getElementById("novasenhaHelp1").innerHTML = "Confirmação da nova senha";
        senha.style.border = ""; 
        confirmar_senha.style.border = "";
        document.getElementById("novasenhaHelp").style.color = "gray";
        document.getElementById("novasenhaHelp1").style.color = "gray";
        document.getElementById("btnSalvarNovaSenha").removeAttribute("disabled"); 
    }   
}, true);
    
</script>
    
<?php get_footer('painel'); ?>
