<?php
    /* Template Name: Login */ 
    get_header('login');
    include( get_template_directory() . '/functions/functions_empresa.php' );
    include( get_template_directory() . '/models/model_empresa.php' );
    include( get_template_directory() . '/functions/functions_login.php' );
    
    if ($_POST) :    
        $msg = autenticacaoCompleta();
    endif;
    
?>
    <form class="form-signin" id="form_login" method="post">
    
        <div class="text-center mb-4">   
            <!--<img class="mb-4" src="<?= get_bloginfo('template_url') ?>/img/img_exemple.png" alt="" width="72" height="72"> -->
            <i class="fa fa-fire fa-4x" aria-hidden="true"></i>
            <h1 class="h3 mb-3 mt-2 font-weight-normal"><?= NOME_APLICACAO ?></h1>
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

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Lembrar-me
            </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block btn-nav-forload"  id="btnLoginEntrar" type="submit" >Entrar</button>
        
        <div class="row mt-3">  
            <div class="col-lg-12 text-center">
                <a href="#" style="text-decoration: none; font-size: 13px">Ainda não tem cadatro? Clique em um dos links abaixo</a>
            </div>        
        </div>
        
        <div class="row mt-5">  
            <div class="col-6 d-flex flex-row">
                <a href="http://restaurantemegachic.com/fidelidade/nova-empresa/" style="text-decoration: none; font-size: 12px">Cadastrar Empresa</a>
            </div>
            <div class="col-6 d-flex flex-row-reverse">
                <a href="http://restaurantemegachic.com/fidelidade/novo-cliente/" style="text-decoration: none; font-size: 12px">Cadastrar Cliente</a>
            </div>
        </div>
        
        <p class="mt-5 mb-3 text-muted text-center">&copy; <?= NOME_APLICACAO ?> <?=  date("Y"); ?></p>
               
    </form>
  

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



