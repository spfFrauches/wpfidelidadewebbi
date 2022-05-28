<?php

    /* Template Name: Login - Painel Cliente*/ 
    get_header('login');
    include( get_template_directory() . '/functions/functions_empresa.php' );
    include( get_template_directory() . '/models/model_empresa.php' );
    include( get_template_directory() . '/functions/functions_login.php' );
    include( get_template_directory() . '/functions/functions_email.php' );
    
    if (isset($_POST['email_recuperacao'])):               
        $enviarEmail = recuperacao_senha($_POST['email_recuperacao']);        
    endif;
    
    if ($_POST['cnpj_cpf']) :    
        $msg = autenticacaoCompleta();
    endif;
    
?>

<div class="form-signin">
    
    <form class="form-signin" id="form_login" method="post"></form>
    
    
    <div class="text-center mb-4 mt-5">   
        <!--<img class="mb-4" src="<?= get_bloginfo('template_url') ?>/img/img_exemple.png" alt="" width="72" height="72"> -->
        <i class="fa fa-fire fa-4x" aria-hidden="true"></i>
        <h1 class="h3 mb-3 mt-2 font-weight-normal"><?= NOME_APLICACAO ?></h1>
        <h1 class="h5 mb-5 font-weight-normal">Painel do Cliente</h1>
        <?php if (isset($msg)) : echo  msgLoginInvalido($msg) ; endif;?>                        
    </div>
    
    <?php if(isset($enviarEmail) &&  $enviarEmail == 'enviado' ): ?>
        <div class="alert alert-primary" role="alert">
            <b>Recuperação de senha solicitada.</b>
            <p class="lead" style="font-size: 13px">A senha foi enviada para o e-mail: <strong><?= $_POST['email_recuperacao'] ?></strong></p>
        </div>
    <?php endif; ?>
    
    <?php if(isset($enviarEmail) && $enviarEmail == 'no-email' ): ?>
        <div class="alert alert-danger" role="alert">
            <b>Ops! Erro</b>
            <br/>
            Recuperação de senha solicitada
            <p class="lead" style="font-size: 12px">Mas nenhum cliente encontrado com o e-mail.:<?= $_POST['email_recuperacao'] ?></p>
        </div>
    <?php endif; ?>
    
    <div class="form-label-group">
        <input 
            type="text" 
            maxlength="18" 
            class="form-control cpf" 
            id="cnpj_cpf" name="cnpj_cpf" 
            form="form_login"
            required autofocus onkeyup="javascript: mascara(this, nocnpjcpf_mask);">
        <label>CPF</label>
    </div>

    <div class="form-label-group">
        <input type="password"  class="form-control" name="passwd" form="form_login" required>
        <label>Senha</label>
    </div>

    <div class="checkbox mb-3">
        <label>
            <a href="#" style="text-decoration: none; font-size: 14px" data-toggle="modal" data-target="#exampleModal">Esqueci minha senha</a>
        </label>
    </div>
        
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                
                <form method="POST" action="#"  id="form_recuperar_senha"> </form>
                
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Recuperação de Senha</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Informe o endereço de e-mail</label>
                            <input 
                                type="email" 
                                class="form-control" 
                                form="form_recuperar_senha" 
                                name="email_recuperacao" 
                                placeholder="name@example.com" required>
                        </div>                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button type="submit" form="form_recuperar_senha" class="btn btn-primary">Recuperar senha</button>
                    </div>
                </div>

            </div>
         </div>
        
        
        <div class="row mt-4">  
            <div class="col text-center">
                <button class="btn btn-lg btn-primary btn-block btn-nav-forload" form="form_login" id="btnLoginEntrar" type="submit" >Entrar</button>
            </div>
        </div>
         
           
        <div class="row mt-5 mb-2">              
            <div class="col-6 d-flex flex-row mt-2">
                 <a href="<?= get_bloginfo('url') ?>/novo-cliente/" style="text-decoration: none; font-size: 12px">Cadastra-se como cliente</a>
            </div>
            <div class="col-6 d-flex flex-row-reverse mt-2">
                <a href="<?= get_bloginfo('url') ?>" style="text-decoration: none; font-size: 12px">Voltar ao site</a>
            </div>
         </div>
        
        <div class="row mt-5 mb-2 text-center"> 
            <div class="col text-center">
                <p class="mt-5 mb-1 text-muted text-center">
                    &copy; <?= NOME_APLICACAO ?> <?=  date("Y"); ?>
                </p>
            </div>
        </div>
               
</div>
 

<?php
    include( get_template_directory() . '/functions/functions_loads.php' );
    get_footer('login');  
?>

<script>
    /* Função para mascaras CNPJ e CPF automatico */
    function mascara(o,f){
        v_obj=o;
        v_fun=f;
        setTimeout("execmascara()",1);
    }
    function execmascara(){
        v_obj.value=v_fun(v_obj.value);
    }
    function remove(str, sub) {
        i = str.indexOf(sub);
        r = "";
        if (i == -1) return str; {
            r += str.substring(0,i) + remove(str.substring(i + sub.length), sub);
        }
        return r;
    }
    function nocnpjcpf_mask(v){ 
        v = remove(v, "-");
        v = remove(v, ".");
        v = remove(v, "/");
        if(v.length < 12){
            v = v.replace(/\D/g,"")
            v = v.replace(/(\d{3})(\d)/,"$1.$2");
            v = v.replace(/(\d{3})(\d)/,"$1.$2");
            v = v.replace(/(\d{3})(\d)/,"$1-$2");
        } else {
            v = v.replace(/\D/g,"");
            v = v.replace(/(\d{2})(\d)/,"$1.$2");
            v = v.replace(/(\d{3})(\d)/,"$1.$2");
            v = v.replace(/(\d{3})(\d)/,"$1/$2");
            v = v.replace(/(\d{4})(\d)/,"$1-$2");
        }
        return v;
    }
</script>



