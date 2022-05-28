<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?= NOME_APLICACAO ?></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Pesquisar" aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3 btnSairPainel" href="<?= get_bloginfo('url') ?>/sair">Sair</a>
        </div>
    </div>
</header>


<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                
                <?php
                    global $wp;
                    $url = home_url( $wp->request );                    
                ?>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>PAINEL</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                      
                    </a>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <?php $url_swp1 = get_bloginfo('url')."/painel-empresa" ?>                        
                        <a class="btn-nav-forload nav-link <?php if ($url == $url_swp1 ) { echo "active";}?>" href="<?= $url_swp1 ?>">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            &nbsp; Home 
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php $url_swp4 = get_bloginfo('url')."/empresas-configuracao" ?> 
                        <a class="btn-nav-forload nav-link <?php if ($url == $url_swp4 ) { echo "active";}?>"href="<?= $url_swp4 ?>">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            &nbsp; Configurações
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <?php $url_swp3 = get_bloginfo('url')."/empresa-meus-clientes" ?> 
                        <a class="btn-nav-forload nav-link <?php if ($url == $url_swp3 ) { echo "active";}?>"href="<?= $url_swp3 ?>">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            &nbsp; Meus Clientes
                        </a>
                    </li>
                                                          
                    <li class="nav-item">
                        <a  target="_blank" class="nav-link" href="<?= get_bloginfo('url')  ?>/site-marcacao/">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                            &nbsp; Site marcação 
                        </a>
                    </li>  
                    
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Pontos e Benefícios</span>
                        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    
                    <li class="nav-item">
                        <?php $url_swp6 = get_bloginfo('url')."/painel-empresa/beneficios-por-pontos/" ?> 
                        <?php 
                            if (isset ($_SESSION['url_referencia']) && $_SESSION['url_referencia'] == 'empresa-beneficios-por-pontos') {
                                $active = "active";
                            }
                         ?>
                        <a class="btn-nav-forload nav-link <?= $active ?>" href="<?= $url_swp6 ?>">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                            &nbsp; Benefícios
                        </a>
                        
                        <?php $url_swp7 = get_bloginfo('url')."/painel-empresa/painel-empresa-resgate-pontos" ?> 
                         
                        <!--
                        <a class="btn-nav-forload nav-link <?= ($url == $url_swp7 ) ? "active" : "" ?>" href="<?= $url_swp7 ?>">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                            &nbsp; Pontos de Clientes
                        </a>
                        -->
                        
                         <?php $url_swp8 = get_bloginfo('url')."/painel-empresa/empresa-solicitacao-resgate" ?> 
                        
                        
                        <a class="btn-nav-forload nav-link <?= ($url == $url_swp8 ) ? "active" : "" ?>" href="<?= $url_swp8 ?>">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                            &nbsp; Solicitações Resgate
                        </a>
                        
                    </li>
                    
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Empresa</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">

                        </a>
                    </h6>
    
                    <li class="nav-item">
                        <?php $url_swp2 = get_bloginfo('url')."/painel-empresa/estorno-movimentos" ?> 
                        <a class="btn-nav-forload nav-link <?php if ($url == $url_swp2 ) { echo "active";}?>" href="<?= $url_swp2 ?>">
                           <i class="fa fa-trash-o" aria-hidden="true"></i>
                            &nbsp; Cancelar Marcação
                         </a>
                    </li>
                    
                    <li class="nav-item">
                        <?php $url_swp99 = get_bloginfo('url')."/painel-empresa/painel-empresa-estorno-resgate" ?> 
                        <a class="btn-nav-forload nav-link <?php if ($url == $url_swp99 ) { echo "active";}?>" href="<?= $url_swp99 ?>">
                           <i class="fa fa-trash-o" aria-hidden="true"></i>
                            &nbsp; Cancelar Solicitação/Resgate
                         </a>
                    </li>
                    
                    <li class="nav-item">
                        <?php $url_swp5 = get_bloginfo('url')."/minha-empresa-alterar-senha" ?> 
                        <a class="btn-nav-forload nav-link <?= ($url == $url_swp5 ) ? "active" : "" ?>" href="<?= $url_swp5 ?>">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            &nbsp; Alterar Senha
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <?php $url_swp2 = get_bloginfo('url')."/minha-empresa" ?> 
                        <a class="btn-nav-forload nav-link <?php if ($url == $url_swp2 ) { echo "active";}?>" href="<?= $url_swp2 ?>">
                            <i class="fa fa-industry" aria-hidden="true"></i>
                            &nbsp; Minha empresa
                         </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                            &nbsp; Tutoriais / Ajuda
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>



