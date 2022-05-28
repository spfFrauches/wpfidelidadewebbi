<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Webi Fidelidade</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input 
        class="form-control form-control-dark w-100" 
        type="text" 
        placeholder="<?= $_SESSION['dados_cliente'][0]->nome_completo  ?>" 
        aria-label="Search" 
        disabled >
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3 btnSairPainel" href="<?= get_bloginfo('url') ?>/sair">Sair</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Painel do Cliente</span>
                    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                
                <?php
                    global $wp;
                    $url = home_url( $wp->request );                    
                ?>
                
                <ul class="nav flex-column">
                    
                    <li class="nav-item">
                        <?php $url_swp1 = get_bloginfo('url')."/painel-cliente" ?>     
                        <a class="btn-nav-forload nav-link <?php if ($url == $url_swp1 ) { echo "active";}?>" href="<?= $url_swp1 ?>">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            &nbsp; Home <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php $url_swp1 = get_bloginfo('url')."/resgates-cliente" ?>     
                        <a class="btn-nav-forload nav-link <?php if ($url == $url_swp1 ) { echo "active";}?>" href="<?= $url_swp1 ?>">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                            &nbsp; Meus Resgates <span class="sr-only">(current)</span>
                        </a>
                    </li>                    
                    
                   
                </ul>
                <hr/>                
                <ul class="nav flex-column">
                    
                    <li class="nav-item">
                        <?php $url_swp2 = get_bloginfo('url')."/cliente-meus-dados" ?>  
                        <a class="btn-nav-forload nav-link <?php if ($url == $url_swp2 ) { echo "active";}?>" href="<?= $url_swp2 ?>">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            &nbsp; Meus dados
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <?php $url_swp3 = get_bloginfo('url')."/cliente-alterar-senha" ?>  
                        <a class="btn-nav-forload nav-link <?php if ($url == $url_swp3 ) { echo "active";}?>" href="<?= $url_swp3 ?>">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            &nbsp; 
                            Alterar Senha
                        </a>
                    </li>
                    
                </ul>
                <hr/>
                <ul class="nav flex-column">    
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-handshake-o" aria-hidden="true"></i>
                            &nbsp; 
                            Termos de uso
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-user-times" aria-hidden="true"></i>
                            &nbsp; Não quero mais 
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        

