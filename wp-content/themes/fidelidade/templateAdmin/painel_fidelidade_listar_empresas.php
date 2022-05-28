<?php 
    
/* Template Name: Painel Fidelidade Admin -  Listar Empresas */
$_SESSION['url_referencia'] = '';
get_header('painel');

require './wp-content/themes/fidelidade/inc/functions_empresa.php';   
global $wpdb; 
$result  = $wpdb->get_results("SELECT * FROM empresas");
    
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    
    <?php 
        
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        
            $id = $_POST['id_delete']; 
            $situacao = $_POST['situaco']; 
            
            //$resultDelete = $wpdb->delete( 'empresas', array('id' => $id), array('%d'));
            if ($situacao == '1') :
                $resultDesativar = $wpdb->update( 'empresas', array( 'fl_situacao' => 0), array( 'id' => $id ) );
            endif;
            
            if ($situacao == '0') :
                $resultDesativar = $wpdb->update( 'empresas', array( 'fl_situacao' => 1), array( 'id' => $id ) );
            endif;
            //$resultDesativar = $wpdb->update( 'empresas', array( 'fl_situacao' => 1), array( 'id' => $id ) );
            
            if ($resultDesativar >= 1) {
                $result  = $wpdb->get_results("SELECT * FROM empresas");
                $msg = "Dados atualizados com sucesso!";
                swalMsgAlertaEmpresaExcluido($msg);
            } 
            
            if ($resultDesativar == 0) {                
                $msg = "Nada a ser desativado!";
                swalMsgAlertaEmpresaNaoExcluido($msg);
            } 
                             
        }
    
    ?>
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Empresas</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a type="button"  href="<?=  get_bloginfo('url'). "/painel/" ?>"  class="btn btn-sm btn-outline-secondary"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Home </a>
            </div>
            <a type="button" target="_blank" href="<?=  get_bloginfo('url'). "/nova-empresa/" ?>"  class="btn btn-sm btn-outline-secondary">
                <span data-feather="calendar"></span>
                Cadastro Empresas
            </a>
        </div>
    </div>
    
    <br/><br/>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="row">Cód</th>
                <td scope="row">Empresa</td>
                <td scope="row">CNPJ</td>
                <td scope="row">Status</td>
                <td scope="row">Ações</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $key => $value) :?>
            <tr>
                <th scope="row"><?= $value->id ?></th>
                <td><?= $value->razao_social ?></td>
                <td><?= $value->cnpj ?></td>
                <td>
                    <?php 

                        if($value->fl_situacao == 0 ):
                            echo '<span class="badge badge-success">Ativo</span>';
                        endif;
                        if($value->fl_situacao == 1 ):
                            echo '<span class="badge badge-danger">Bloqueado/Desativado</span>';
                        endif;
                    ?>
                </td>
                <td> 
                       
                    <!-- Button trigger modal -->
                    <a href="#" data-toggle="modal" data-target="#bloquearModal<?= $value->id ?>"  data-toggle="tooltip" data-placement="right" title="Inativar Empresa">                                               
                        <?php if($value->fl_situacao == 0 ): ?>
                            <i class="fa fa-toggle-on" aria-hidden="true"></i>
                        <?php endif;?>
                        <?php if($value->fl_situacao == 1 ): ?>
                            <i class="fa fa-toggle-off" aria-hidden="true"></i>
                        <?php endif;?>                       
                    </a>
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="bloquearModal<?= $value->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Desabilitar/Bloquear Empresa </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php if($value->fl_situacao == 0 ): ?>                                    
                                        <p>Tem certeza que deseja bloquear?</p>                                   
                                    <?php endif;?>  
                                        <?php if($value->fl_situacao == 1 ): ?>                                    
                                        <p>Tem certeza que deseja liberar?</p>                                    
                                    <?php endif;?>  
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                             Empresa .:
                                             <span class="badge badge-secondary badge-pill" style="font-size:14px">
                                                 <?= $value->razao_social ?>
                                             </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                             CNPJ .:
                                             <span class="badge badge-secondary badge-pill" style="font-size:14px">
                                                 <?= $value->cnpj ?>
                                             </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                             Cód .:
                                             <span class="badge badge-secondary badge-pill" style="font-size:14px">
                                                 <?= $value->id ?>
                                             </span>
                                        </li>
                                       
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    
                                    <form action="<?= bloginfo('url') . "/listas-empesas/" ?>" method="post">
                                    
                                        <input type="hidden" name="id_delete" value="<?= $value->id ?>">
                                        <input type="hidden" name="situaco" value="<?= $value->fl_situacao ?>">
                                        
                                        <?php if($value->fl_situacao == 0 ): ?>                                    
                                        <button type="submit" class="btn btn-primary">Desativar/Bloquear</button>                                
                                        <?php endif;?>  
                                        <?php if($value->fl_situacao == 1 ): ?>                                    
                                            <button type="submit" class="btn btn-primary">Liberar / Ativar</button>                                 
                                        <?php endif;?>  
                                        
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                                 
                </td>
            </tr>
            
            <?php endforeach; ?>

        </tbody>
    </table>
</main>

<?php get_footer('painel'); ?>
