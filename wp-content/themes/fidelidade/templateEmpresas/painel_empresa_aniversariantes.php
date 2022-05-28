<?php

/* Template Name: Painel Empresa - Aniversariantes */ 
$_SESSION['url_referencia'] = '';    
if ($_SESSION['login_painel'] != 'empresa'):
    $url = get_bloginfo('url')."/login";
    header("Location:$url");
    exit("A sessão foi expirada ou é invalida");
endif; 

include( get_template_directory() . '/models/model_clientes.php' );

$listarCliente = clientesPorEmpresa($_SESSION['dados_empresa'][0]->cnpj);
        
get_header('painel'); 

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3">
      
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Aniversariantes <small>do dia</small> <i class="fa fa-birthday-cake" aria-hidden="true"></i></h2>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                                     
                    <p style="font-size: 19px">
                        
                        <?php 
                            $dataAtual = date('Y-m-d');
                            setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                            echo ucfirst( utf8_encode( strftime("%A, %d de %B de %Y", strtotime($dataAtual) ) ) );    
                        ?>
                                                
                    </p>
                    <p style="margin-top: -13px">
                        <?= date('d/m/Y', strtotime($dataAtual)) ?>
                    </p>
                                        
                </div>
           </div>
        </div>
    </div>

       
    <div class="row mt-3">
        <div class="col-lg-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Idade</th>
                        <th scope="col">Nascimento</th>
                        <th scope="col">Telefone</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach ($listarCliente as $key => $value): ?>
                    <?php 
                        $hoje = date("d-m");
                        $dataNiver = date("d-m" , strtotime($value->data_nascimento));
                    ?>
                    <tr class="<?= $hoje == $dataNiver ? "table-success" : "" ?>">
                        <td><?= strtoupper($value->nome_completo) ?></td>
                        <td>                            
                            <?php 
                                $data = $value->data_nascimento;
                                list($ano, $mes, $dia) = explode('-', $data);
                                $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                                $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
                                $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                                echo $idade." anos" ;
                            ?>                                                  
                        </td>
                        <td><?= date("d/m/Y ", strtotime($value->data_nascimento)) ?>      </td>
                        
                        <td><?= $value->fone ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
</main>


<?php get_footer('painel') ?>
