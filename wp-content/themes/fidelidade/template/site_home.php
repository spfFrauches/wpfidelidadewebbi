<?php 
/* Template Name: Site Home */
$_SESSION['url_referencia'] = '';
get_header('site');
?>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <section class="text-center" style="background-color:#b9b9b9; height: 400px">
                <div class="container">
                    <br/><br/><br/>
                    <h1 class="text-black-50"><?= NOME_APLICACAO ?></h1>
                    <br/>
                    <p class="lead text-muted text-black-50">
                        Crie o cartão fidelidade Web para seus cliente em apenas 2 minutos. 
                    </p>
                    <br/>
                    <p>
                        <a href="<?= get_bloginfo('url') ?>/novo-cliente/" class="btn btn-primary my-2 btn-CadastroCliente">Para Clientes</a>
                        <a href="<?= get_bloginfo('url') ?>/nova-empresa/" class="btn btn-secondary my-2 btn-CadastroEmpresa" >Para empresas</a>
                    </p>
                </div>
            </section>
        </div>
        <div class="carousel-item">
            <section class="text-center" style="background-color:#b9b9b9; height: 400px">
                <div class="container">
                    <br/><br/><br/>
                    <h1 class="text-black-50">Fidelidade Web</h1>
                    <br/>
                    <p class="lead text-muted text-black-50">
                        Crie o cartão fidelidade Web para seus cliente em apenas 2 minutos. 
                    </p>
                    <br/>
                    <p>
                        <a href="<?= get_bloginfo('url') ?>/novo-cliente" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#modalLoad">Para Clientes</a>
                        <a href="<?= get_bloginfo('url') ?>/nova-empresa/" class="btn btn-secondary my-2" data-bs-toggle="modal" data-bs-target="#modalLoad">Para empresas</a>
                    </p>
                </div>
            </section>
        </div>
        <div class="carousel-item">
            <section class="text-center" style="background-color:#b9b9b9; height: 400px">
                <div class="container">
                    <br/><br/><br/>
                    <h1 class="text-black-50">Fidelidade Web</h1>
                    <br/>
                    <p class="lead text-muted text-black-50">
                        Crie o cartão fidelidade Web para seus cliente em apenas 2 minutos. 
                    </p>
                    <br/>
                    <p>
                        <a href="<?= get_bloginfo('url') ?>/novo-cliente" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#modalLoad">Para Clientes</a>
                        <a href="<?= get_bloginfo('url') ?>/nova-empresa/" class="btn btn-secondary my-2" data-bs-toggle="modal" data-bs-target="#modalLoad">Para empresas</a>
                    </p>
                </div>
            </section>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container">         
    <div class="row featurette mt-5">
        <div class="col-lg-7" style="padding-top: 100px;">
            <h2 class="featurette-heading">
                Modernize seu cartão fidelidade
            </h2>
            <h2 class="featurette-heading">
                <span class="text-muted">Crie e compartilhe com seus clientes.</span>
            </h2>
            <p class="lead">Para criar seu cartão fidelidade web é muito simples, faça seu cadastro, configure como será seu cartão e pronto! Em apenas 2 minutos você tem tudo pronto!</p>
        </div>
        <div class="col-md-5 text-right mt-5">
            <img class="img-fluid" src="<?= get_bloginfo('template_url')  ?>/img/img_exemple.png">
        </div>
    </div>    
</div>

<div class="container">  
    <hr/>
</div>

<div class="container">  
    <div class="row featurette">
        <div class="col-lg-5 text-left">
            <img class="img-fluid" src="<?= get_bloginfo('template_url')  ?>/img/img_exemple.png">
        </div>     
        <div class="col-lg-7" style="padding-top: 100px; padding-left: 50px">
            <h2 class="featurette-heading">
                Acesso fácil e rapido para seus clientes
            </h2>
            <h2 class="featurette-heading">
                <span class="text-muted">Seus clientes vão adorar!</span>
            </h2>
            <p class="lead">
                Com o cartão fidelidade web eles poderão acompanhar as marcações em seus cartões e conferir os brindes e promoções.
                Agora ele não corre o risco de perder o cartão, está tudo na web com acesso nas palmas de suas mãos.
            </p>
        </div>     
    </div>
</div>

<div class="container mb-5 mt-5">  
    <hr/>
</div>

<?php  get_footer('site');  ?>

