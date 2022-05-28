<?php 
/* Template Name: Site Cadastro Novo Cliente */ 
$_SESSION['url_referencia'] = '';
get_header('sitetmpl4'); 
$caminhoImgDefault = get_bloginfo('template_url')."/img/default-user-1.png";  
?>
<style>

    .mobile-form {
        border:none;
        border-bottom: 1px solid #213c57;        
        border-radius: 0;
        box-shadow: none !important;         
    }

</style>

<br/><br/>
<aside class="bg-gradient-primary-to-secondary primary-to-secondary  pt-5 pb-5">
    <div class="container">
        <div class="row mt-4">
            <div class="col-xl-8">
                <div class="h1 text-white">
                    Webi Club Fidelidade
                </div>
                <p class="lead text-white">
                    Tenha seu webi fidelidade. Cadastro de clientes
                </p>
                <br/>
            </div>
            <div class="col-xl-4 text-end">            
                <a class="btn btn-outline-light py-4 px-5 mb-4 rounded-pill" href="<?= get_bloginfo('url') ?>/login-painel-cliente/" target="_blank">
                    Já sou cadastrado
                </a>
            </div>
        </div>
    </div>
</aside>

<div class="container px-5 mt-5">  
    <div class="row gx-5">
        
        <div class="col-lg-6 order-lg-0">
            <div class="features-device-mockup">                
                <div  class="mb-5" >
                    <form method="post" action="<?= get_bloginfo('url') ?>/finalizar-cadastro-cliente" class="needs-validation" novalidate enctype="multipart/form-data">             
                        <div class="row card p-1" id="form_cadastroCliente" style="border: 2px solid #272045">           
                            <div class="col-lg-12 order-lg-1">    
                                <div class="row mt-3">      
                                    <div class="col-lg-4">          
                                        <img id="previewImg" class="img-thumbnail" style="border: none" width="150" src="<?= $caminhoImgDefault  ?>" alt="Selfie">                                   
                                    </div>
                                    <div class="col-lg-8">    
                                        <div class="row">                               
                                            <div class="col-lg-12 mb-3">
                                                <label id="nome_label" style="font-size: 14px">Nome completo</label>
                                                 <input type="text" class="form-control form-control-sm mobile-form" id="nomeCompleto" name="nome_completo" onblur="analisarNomeCompleto()"  >
                                                 <div id="nomeCompletoHelp" class="form-text"></div>
                                            </div>  
                                            <div class="col-lg-12">
                                                <label for="formFileSm" class="form-label" style="font-size: 14px">Foto</label>
                                                <input style="margin-top: -5px" class="form-control form-control-sm mobile-form" id="formFileSm" type="file" name="selfcliente"  onchange="previewFile(this);"  accept="image/*" >
                                            </div>
                                        </div>                                 
                                    </div>        
                                </div>      
                                <div class="row mt-5">
                                    <div class="col-lg-12 mb-2">
                                        <label id="cpf_label" class="form-label" style="font-size: 14px">CPF</label>
                                        <input type="text" class="form-control cpf mobile-form" id="cpf" name="cpf_cliente" onblur="analisarCpf()" >
                                        <div id="cpfHelp" class="form-text"></div>
                                    </div>    
                                </div>                                                                 
                                <div class="row">
                                    <div class="col-lg-6 mb-2">
                                        <label id="nascimento_label" class="form-label" style="font-size: 14px">Nascimento *</label>
                                        <input type="date" class="form-control mobile-form" id="data_nascimento" name="data_nascimento"  onblur="analisarDataNascimento()" >
                                        <div id="nascimentoHelp" class="form-text"></div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label id="sexo_label" class="form-label " style="font-size: 14px">Sexo <span class="text-muted"></span></label>
                                        <select class="form-control mobile-form" id="sexo" name="sexo" onblur="analisarSexo()">
                                            <option value=''></option>
                                            <option value='M'>Masculino</option>
                                            <option value="F">Femenino</option>                           
                                        </select>
                                        <div id="sexoHelp" class="form-text"></div>
                                    </div> 
                                </div>                                 
                                <div class="row">               
                                    <div class="col-lg-6 mb-2">
                                        <label id="telefone_label" class="form-label" style="font-size: 14px">Telefone *<span class="text-muted"></span></label>
                                        <input type="text" class="form-control telefoneform mobile-form" id="telefone" name="telefone" onblur="analisarTelefone()" >
                                        <div id="telefoneHelp" class="form-text"></div>
                                    </div>   
                                    <div class="col-lg-6 mb-2">
                                        <label id="email_label" class="form-label" style="font-size: 14px">E-mail *</label>
                                        <input type="email" class="form-control mobile-form" id="email" name="email" >
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>                                                       
                                </div>  
                                
                                <div class="row"> 
                                    <div class="col-lg-6 mb-2" >
                                        <label id="senhaCliente" class="form-label" style="font-size: 14px">Senha</label>
                                        <input type="password" class="form-control mobile-form" name="senha" id="senha_cliente">
                                        <div id="senhaHelp" class="form-text"></div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label id="senhaClienteConfirmar" class="form-label" style="font-size: 14px">Confirmar Senha </label>
                                        <input type="password" class="form-control mobile-form" name="password_confirma" id="senha_cliente_confirma" >
                                        <div id="senhaConfirmaHelp" class="form-text"></div>
                                    </div>
                                </div>               
                
                                <div class="row mt-5">
                                    <div class="col-lg-12">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="termos_contrato" required="" name="termos_contrato" value="SIM">
                                            <label class="form-check-label">
                                                Eu aceito e concordo com o termos e condições do uso. 
                                            </label>                                                 
                                        </div>
                                    </div>
                                </div>                               
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="form-group form-check">
                                                <a href="#">Clique aqui</a> para ler os termos
                                            </label>              
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5 mb-5">
                                    <div class="col-lg-6"></div>
                                    <div class="col-lg-6">
                                        <div class="d-grid gap-1 col-12 mx-auto">
                                            <button class="btn btn-primary btn-lg btn-block" id="btnContinuarCadastroCliente" style="background-color: #223754">
                                                Continuar 
                                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                            </button>   
                                        </div>
                                    </div>
                                </div>               
                            </div> 
                        </div>     
                    </form>
                </div>

                <!-- Modal Para Efeito de Load Apenas -->
                <div class="modal fade" id="modalLoad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
                        <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none" >
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div class="spinner-border text-light" role="status">
                                        <span class="visually-hidden"></span>
                                    </div>
                                </div> 
                                <div class="col-lg-12 text-center">
                                    <p class="text-light" style="font-size: 18px">Carregando, por favor aguarde</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        
        
        
        <div class="col-lg-6 order-lg-1 mb-5">
            <div class="container-fluid px-5">
                <div class="row gx-5">
                    <img src="<?php bloginfo('template_url') ?>/img/cashback1.png" class="img-fluid" alt="">
                </div>
                
                <div class="row mt-2">
                    <div class="col-md-6">
                        <!-- Feature item-->
                        <div class="">
                            <i class="bi-gift icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Cadastre-se</h3>
                            <p class="text-muted mb-0">Entre no app e acompanhe seu cashback</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Feature item-->
                        <div class="">
                            <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Ganhe pontos</h3>
                            <p class="text-muted mb-0">Sobre resgatar brindes</p>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <!-- Feature item-->
                        <div class="">
                            <i class="bi-gift icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Brindes</h3>
                            <p class="text-muted mb-0">Entre no app e acompanhe seu cashback</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Feature item-->
                        <div class="">
                            <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Cashback</h3>
                            <p class="text-muted mb-0">Sobre resgatar brindes</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        
    </div>
</div>

<?php get_footer('sitetmpl4'); ?>

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
</script> 

<script src="<?php bloginfo('template_url') ?>/ajax/ajax_clientes.js?v=1.0"></script>






