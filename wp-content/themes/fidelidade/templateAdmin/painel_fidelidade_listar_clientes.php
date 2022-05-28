<?php 
    
/* Template Name: Painel Fidelidade Admin -  Listar Clientes */ 
$_SESSION['url_referencia'] = '';
get_header('painel');

require './wp-content/themes/fidelidade/inc/functions_empresa.php';   
global $wpdb; 
$result  = $wpdb->get_results("SELECT * FROM clientes");
    
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Clientes</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a type="button"  href="<?=  get_bloginfo('url'). "/painel/" ?>"  class="btn btn-sm btn-outline-secondary"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Home </a>
            </div>
            <a type="button" target="_blank" href="<?=  get_bloginfo('url'). "/novo-cliente/" ?>"  class="btn btn-sm btn-outline-secondary">
                <span data-feather="calendar"></span>
                Cadastro Clientes
            </a>
        </div>
    </div>
    
    <br/><br/>
    
    <?php //var_dump($result[0]); ?>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="row">Cód</th>
                <td scope="row">Nome</td>
                <td scope="row">CPF</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $key => $value) :?>
            <tr>
                <th scope="row"><?= $value->id ?></th>
                <td scope="row"><?= $value->nome_completo ?></td>
                <td scope="row"><?= $value->cpf ?></td>
            </tr>
            
            <?php endforeach; ?>

        </tbody>
    </table>
</main>

<?php get_footer('painel'); ?>
