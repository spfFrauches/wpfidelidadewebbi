<?php
    /* Template Name: Login App */ 
    get_header('login');
    include( get_template_directory() . '/functions/functions_empresa.php' );
    include( get_template_directory() . '/models/model_empresa.php' );
    include( get_template_directory() . '/functions/functions_login.php' );
    
    if ($_POST) :    
        $msg = autenticacaoApp();
    endif;    
?>
    <form class="form-signin" id="form_login" method="post"> 
        
        <div class="text-center mb-4">   
            <!--<img class="mb-4" src="<?= get_bloginfo('template_url') ?>/img/img_exemple.png" alt="" width="72" height="72"> -->
            <i class="fa fa-grav fa-4x" aria-hidden="true"></i>
            <h1 class="h3 mb-3 mt-2 font-weight-normal"><?= NOME_APLICACAO ?></h1>
            <h1 class="h5 mb-3 mt-2 font-weight-normal">App</h1>
            <?php if (isset($msg)) : echo  msgLoginInvalido($msg) ; endif;?>                      
        </div>

        <div class="form-label-group">
            <input type="text" maxlength="18" class="form-control" id="cnpj_cpf" name="cnpj_cpf" required autofocus onkeyup="javascript: mascara(this, nocnpjcpf_mask);">
            <label>CNPJ ou CPF</label>
        </div>

        <div class="form-label-group">
            <input type="password"  class="form-control" name="passwd" required>
            <label>Senha</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block btn-nav-forload"  type="submit" >
            Entrar
        </button>
  
        <p class="mt-5 mb-3 text-muted text-center">
            &copy; <?= NOME_APLICACAO ?> <?=  date("Y"); ?>
        </p>
               
    </form>
   
<?php
    include( get_template_directory() . '/functions/functions_loadsApp.php' );
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



