<?php 

    /* Template Name: Painel Cadastro Empresa */ 
    get_header('painel');
    
    require './wp-content/themes/fidelidade/inc/functions_empresa.php';
    require './wp-content/themes/fidelidade/models/model_empresa.php';
    $nextEmpresaID = nextID();
?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        
    <?php
        if ($_POST) {
                   
            $array_insert = [
                'razao_social' => $_POST['razao_social'],
                'nome_fantasia' => $_POST['nome_fantasia'],
                'cnpj' =>  $_POST['cnpj'],
                'tipo_cartao' =>  $_POST['tipo_cartao']
            ];
            
            $result = insertDB($array_insert);
            $nextEmpresaID = nextID();
         
            if (!$result) {
                $msg = "Não foi possivel cadastrar a empresa";
                swalMsgAlertaEmpresaCadastroErro($msg);
                
            } else {
                $msg = "Empresa cadastrada com sucesso!";
                swalMsgAlertaEmpresaCadastroSucesso($msg);
            }
            
        }

    ?>
   
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastro de empresa</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">QR Code</button>
            </div>
            
            <a type="button" href="<?= get_bloginfo('url') ?>/listas-empesas/" class="btn btn-sm btn-outline-secondary"> 
                Ver todas as empresas
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">QR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fa fa-qrcode fa-5x" aria-hidden="true"></i>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar imagem</button>
                </div>
            </div>
        </div>
    </div>
    
    <br/><br/>
    
    <form class="needs-validation" novalidate action="" method="post">
        
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label>Cód. Emp</label>
                <input type="text" class="form-control" value="<?= $nextEmpresaID[0]->ID + 1 ?>" readonly="">
            </div>
            <div class="col-md-9 mb-3">
                <label >Razão Social</label>
                <input type="text" class="form-control" name="razao_social" required>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>
        </div>
        
        <div class="form-row">
            
            <div class="col-md-6 mb-3">
                <label>Nome Fantasia</label>
                <input type="text" class="form-control" name="nome_fantasia" required>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>
           
            <div class="col-md-6 mb-3">
                <label>CNPJ</label>
                <input type="text" class="form-control" name="cnpj" id="cnpj"  required>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>
            
        </div>
        
        <div class="form-row">
            
            <div class="col-md-6 mb-3">
                <label>Senha </label>
                <input type="password" class="form-control" name="password" id="password" required>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>
           
            <div class="col-md-6 mb-3">
                <label>Confirmar Senha</label>
                <input type="password" class="form-control" name="password_confirma" id="password_confirma" required>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>
            
        </div>
        
        <hr/>
        <h4>Configurações do Cartão</h4>
        <br/>
        
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label>Tipo de Marcação</label>
                    <select class="form-control" name="tipo_cartao" required="">
                        <option>Selecione</option>
                        <option value="pontos">Por pontos</option>
                        <option value="quantidade">Por quantidade de marcação</option>
                        <option value="valor">Por valor</option>
                    </select>
                </div>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>     
        </div>
        
        <button class="btn btn-primary" type="submit" disabled="">Salvar</button>
        
    </form>
  
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
</script>
<?php get_footer('painel'); ?>



