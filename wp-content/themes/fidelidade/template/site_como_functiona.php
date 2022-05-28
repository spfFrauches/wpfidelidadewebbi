<?php 

/* Template Name: Site Como Funciona */
$_SESSION['url_referencia'] = '';
get_header('site');
    
?>
<br/>

<div class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Veja como funciona</h1>
    <p class="lead">
        Com o fidelidade web você moderniza seu tradicional programa de fidelidade.
        Oferecendo ao seu cliente um cartão web, com marcações seguras, simples e rápidas
        na palma da sua mão como o cartão tradicional, só que muito melhor, mais preciso!s
    </p>
</div>
    
<br/>

<div class="container">   
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= get_bloginfo('template_url') ?>/img/img_slide_exemple.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-left">
                    <h5>Passo 1</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= get_bloginfo('template_url') ?>/img/img_slide_exemple.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-left">
                    <h5>Passo 2</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= get_bloginfo('template_url') ?>/img/img_slide_exemple.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-left">
                    <h5>Passo 3</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<br/><br/>

<div class="container marketing">   
    <div class="row text-center">
        
        <div class="col-lg-4">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
            <h2>Passo 1</h2>
            <p>
                Primeiro Cadastre sua empresa e obtenha o
                Link web do cartão.
            </p>
            <p><a class="btn btn-secondary" href="#" role="button">Ver detalhes »</a></p>
        </div>
        
        <div class="col-lg-4">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
            <h2>Passo 2</h2>
            <p>
                Configure como será seu cartão! É simples e intuitivo!
            </p>
            <p><a class="btn btn-secondary" href="#" role="button">Ver detalhes »</a></p>
        </div>
        
        <div class="col-lg-4">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
            <h2>Passo 3</h2>
            <p>
                Marque o consumo do seu cliente e fidalize-o na Web! 
            </p>
            <p><a class="btn btn-secondary" href="#" role="button">Ver detalhes »</a></p>
        </div>
        
    </div>
    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">
            Fidelize <span class="text-muted"> seus clientes </span></h2>
            <p class="lead">
                Diversas formas criar seu cartão com sistema de pontos, quantidade de marcações, 
                cupons de descontos e muito mais...
            </p>
        </div>
        <div class="col-md-5">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        
        <div class="col-md-7 order-md-2">
            
            <h2 class="featurette-heading">
                Configure seu <span class="text-muted"> cartão web</span>
            </h2>
            <p class="lead">
                Diversas formas criar seu cartão com sistema de pontos, quantidade de marcações, cupons de descontos e muito mais...
            </p>
        </div>
      <div class="col-md-5 order-md-1">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">Atraia seus clientes. <span class="text-muted"> Brindes e CashBack</span></h2>
            <p class="lead">
                Com esquemas de brindes e cashback (dinheiro de volta) seus clientes
                vão dar preferecia a sua empresa!
            </p>
        </div>
        <div class="col-md-5">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
        </div>
    </div>

</div>

<br/><br/>


<?php get_footer('site') ?>

