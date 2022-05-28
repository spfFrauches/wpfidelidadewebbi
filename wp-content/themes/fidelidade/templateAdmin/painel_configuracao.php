<?php 

    /* Template Name: Painel Configuração */ 
    get_header('painel');
    require './wp-content/themes/fidelidade/models/model_marcacao.php';    
    
    setlocale( LC_ALL, 'pt_BR.utf-8', 'pt_BR', 'Portuguese_Brazil');
    date_default_timezone_set('America/Bahia');
    
    /* chumnbado provisoriamente pois sera dinamico conforme login da empresa */
    $empresa_marcacao = "00.000.000/0000-01";
   
?>

<br/><br/>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">  
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Marcaçao de Cartão Fidelidade </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a type="button" class="btn btn-sm btn-outline-secondary">QR Code</a>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary">
                Home
            </button>
        </div>
    </div>
        
    <br/><br/>
        
    <form class="needs-validation" novalidate action="" method="post">

        <div class="form-row">
           
            <div class="col-lg-12">
                <label>Tipo Marcação</label>
                <select class="form-control"  name="tipo_marcacao"  required="">
                    <option></option>
                    <option value="Pontos" <?= (isset ($_POST['tipo_marcacao'])) == 'Pontos' ? "selected" : ""; ?>>Por Pontos</option>
                    <option value="Quantidade" <?= (isset ($_POST['tipo_marcacao'])) == 'Quantidade' ? "selected" : ""; ?>>Por Cashback</option>
                </select>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>
            
        </div> 

        <button class="btn btn-primary" type="submit">Pesquisar</button>

    </form>
    
    <!-- IMPRIMINDO MARCAÇÃO DO CARTÃO CONFORME CLIENTE E TIPO DE MARCAÇÃO -->
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    
    <br/>
    
    <div class="row card">
        
        <?php if ( isset ($_POST['cpf_marcacao']) && isset($_POST['tipo_marcacao']) ) : ?>
    
            <div class="col-lg-12">
                
                <?php $resultadoCliente  =  buscarCliente( $_POST['cpf_marcacao']) ;?>
                               
                <?php 
                
                    var_dump($resultadoCliente);
                    echo "<br/>";
                    var_dump($resultadoCliente[0]->cpf);
                
                ?>
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <?php if (!$resultadoCliente) : ?>
                        <h1 class="h4">Nenhum cliente encontrado com esse CPF</h1>
                    <?php else:  ?>
                        <h1 class="h4">
                            <?=$resultadoCliente[0]->nome_completo ?>
                        </h1>
                    <?php endif; ?>  
                </div>
                
                <?php if ($resultadoCliente) : ?>
                
                    <div class="row">

                        <?php  
                            $x = date("D, d/m/Y h:i:sa");
                            $uppercaseMonth = ucfirst(gmstrftime('%A'));
                            $date = strftime($uppercaseMonth.' , %d de %B de %Y', strtotime('today')); 

                            function convertUTF8($date){

                                if(mb_detect_encoding($date, 'UTF-8', true) === false)
                                $date = utf8_encode($date);
                                return $date;

                            }
                        ?>

                        <div class="col-lg-12">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tipo de marcação
                                    <span class="badge badge-primary badge-pill"><?= $_POST['tipo_marcacao'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Data e Hora
                                    <span class="badge badge-primary badge-pill"><?=  convertUTF8($date) ?></span>
                                </li>
                            </ul>
                        </div>

                    </div>
                
                    <br/><br/>
                
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <p>    
                                <a class="badge badge-pill badge-info" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" style="font-size: 12px"> Marcar no cartão </a>
                                <a class="badge badge-pill badge-secondary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2" style="font-size: 12px"> Resumo de marcação </a>
                                <a class="badge badge-pill badge-warning" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2" style="font-size: 12px"> Ver tudo </a>
                            </p>
                            
                            <div class="row">
                                
                                <div class="col">
                                  
                                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                                        <div class="card card-body">
                                            <h4>Marcar <small>no cartão</small> </h4>
                                            <form class="form-inline" action="" method="post"> 
                                                
                                                <label class="sr-only">Valor</label>
                                                
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">R$</div>
                                                    </div>
                                                    
                                                    <input type="hidden" name="cliente" value="<?= $resultadoCliente[0]->cpf ?>">
                                                    <input type="hidden" name="empresa" value="<?= $empresa_marcacao ?>">
                                                    <input type="hidden" name="datahora" value="<?= date('Y-m-d H:i:s') ?>">
                                                    
                                                    <input type="text" class="form-control" name="valor" placeholder="Valor">
                                                                                                       
                                                </div>

                                                <button type="submit" class="btn btn-primary mb-2">Marcar</button>
                                            </form>
                                        </div>                                 
                                    </div>
                                    
                                </div>
                                
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                                        <div class="card card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Qtd Pontos
                                                    <span class="badge badge-primary badge-pill">14</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Qtd Marcações
                                                    <span class="badge badge-primary badge-pill">14</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <br/><br/>
                
                <?php endif; ?>  
                           
            </div> <br/>
    
        <?php endif; ?>
    </div>
    <br/>
    <?php endif; ?>
    <!-- FIM DE IMPRIMINDO MARCAÇÃO DO CARTÃO CONFORME CLIENTE E TIPO DE MARCAÇÃO -->  
        
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