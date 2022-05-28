<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Webi Fidelidade</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="<?= get_bloginfo('url') ?>/sair">Sair</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                 <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>ADMIN</span>
                    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link active" href="<?= get_bloginfo('url') ?>/painel/">
                        <span data-feather="home"></span>
                        Dashboard <span class="sr-only">(current)</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?= get_bloginfo('url') ?>/listas-empesas/">
                        <span data-feather="file"></span>
                        Empresas
                      </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= get_bloginfo('url') ?>/listar-clientes/">
                            <span data-feather="shopping-cart"></span>
                            Clientes
                        </a>
                    </li>
                   
                </ul>

               

            </div>
        </nav>

