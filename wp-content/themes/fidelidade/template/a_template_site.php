<?php 
/* Template Name: Site - Home (rc) */ 
get_header('sitetmpl4');
?>

<style>
    @media(max-width: 600px) {
        .imgDemo {
            visibility: hidden;
        }
        .propEmpresa {
            margin-top: -280px;
        }
    }
</style>

<header class="masthead">
    <div class="container px-5">
        
        <div class="row gx-5 align-items-center">        
            <div class="col-lg-6">
                <div class="mb-5 mb-lg-0 text-center text-lg-start">
                    <h1 class="display-1 lh-1 mb-3">WebiFidelidade</h1>
                    <p class="lead fw-normal text-muted mb-5">
                        Um texto explicando sobre o formato cashback desse
                        software.
                    </p>
                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <a class="me-lg-3 mb-4 mb-lg-0" href="#!">
                            <img class="app-badge" src="<?php bloginfo('template_url') ?>/dist/4/assets/img/google-play-badge.svg"  />
                        </a>
                    </div>
                </div>
            </div>               
            <div class="col-lg-6">
                <div class="masthead-device-mockup mb-5">
                    <svg class="circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                                <stop class="gradient-start-color" offset="0%"></stop>
                                <stop class="gradient-end-color" offset="100%"></stop>
                            </linearGradient>
                        </defs>
                        <circle cx="50" cy="50" r="50"></circle></svg
                    ><svg class="shape-1 d-none d-sm-block" viewBox="0 0 240.83 240.83" xmlns="http://www.w3.org/2000/svg">
                        <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(120.42 -49.88) rotate(45)"></rect>
                        <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(-49.88 120.42) rotate(-45)"></rect></svg
                    ><svg class="shape-2 d-none d-sm-block" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="50"></circle></svg>
                    <div class="device-wrapper">
                        <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                            <div class="screen bg-black">
                                <!-- PUT CONTENTS HERE:-->
                                <!-- * * This can be a video, image, or just about anything else.-->
                                <!-- * * Set the max width of your media to 100% and the height to-->
                                <!-- * * 100% like the demo example below.-->
                                <video muted="muted" autoplay="" loop="" style="max-width: 100%; height: 100%"><source src="assets/img/demo-screen.mp4" type="video/mp4" /></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</header>
     
    <section id="clientes">   
        
        <aside class="bg-gradient-primary-to-secondary primary-to-secondary mb-5 ">
            <div class="container">
                <div class="row pt-5 pb-5">
                    <div class="col-xl-6 mt-3">
                        <div class="h1 text-white">
                            Faça seu cadastro
                        </div>
                        <p class="text-white">
                            É rápido e fácil. Obtenha cashback em brindes e beneficios.
                        </p>
                        <!--
                        <img src="<?php bloginfo('template_url') ?>/dist/4/assets/img/tnw-logo.svg" alt="..." style="height: 3rem" />
                        -->
                    </div>
                    <div class="col-xl-6 text-end mt-3">
                        <a class="btn btn-outline-light py-4 px-5 mb-4 rounded-pill" href="<?= get_bloginfo('url') ?>/novo-cliente/" target="_blank">Cadastre-se como cliente</a>
                    </div>
                </div>
            </div>
        </aside>
   
        <div class="container px-5 mt-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-8 order-lg-1 mb-5 mb-lg-0">
                    <div class="container-fluid px-5">
                        <div class="row gx-5">
                            <div class="col-md-6 mb-5">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="bi-phone icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt">Cadastre-se</h3>
                                    <p class="text-muted mb-0">É rapido e fácil</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="bi-camera icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt">Peça para te marcar</h3>
                                    <p class="text-muted mb-0">
                                        Sobre os pontos trocados por brindes
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-5 mb-md-0">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="bi-gift icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt">Some pontos!</h3>
                                    <p class="text-muted mb-0">Entre no app e acompanhe seu cashback</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt">Troque por brindes</h3>
                                    <p class="text-muted mb-0">Sobre resgatar brindes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-lg-0">
                    <!-- Features section device mockup-->
                    <div class="features-device-mockup mb-5">
                        <svg class="circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                                    <stop class="gradient-start-color" offset="0%"></stop>
                                    <stop class="gradient-end-color" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="50"></circle></svg
                        ><svg class="shape-1 d-none d-sm-block" viewBox="0 0 240.83 240.83" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(120.42 -49.88) rotate(45)"></rect>
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(-49.88 120.42) rotate(-45)"></rect></svg
                        ><svg class="shape-2 d-none d-sm-block" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="50"></circle></svg>
                        <div class="device-wrapper">
                            <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                                <div class="screen bg-black">
                                    <!-- PUT CONTENTS HERE:-->
                                    <!-- * * This can be a video, image, or just about anything else.-->
                                    <!-- * * Set the max width of your media to 100% and the height to-->
                                    <!-- * * 100% like the demo example below.-->
                                    <video muted="muted" autoplay="" loop="" style="max-width: 100%; height: 100%"><source src="assets/img/demo-screen.mp4" type="video/mp4" /></video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <section id="empresas">   
        
        <aside class="bg-gradient-primary-to-secondary primary-to-secondary mb-5 ">
            <div class="container">
                
                <div class="row pt-5 pb-5">
                    <div class="col-xl-6 mt-3">
                        <div class="h1 text-white">
                            Implante em seu estabelecimento
                        </div>
                        <p class="text-white">
                           É rápido e fácil. Mais engajamento com seu cliente.
                        </p>
                        <!--
                        <img src="<?php bloginfo('template_url') ?>/dist/4/assets/img/tnw-logo.svg" alt="..." style="height: 3rem" />
                        -->
                    </div>
                    <div class="col-xl-6 text-end mt-3">
                        <a class="btn btn-outline-light py-4 px-5 mb-4 rounded-pill" href="<?= get_bloginfo('url') ?>/nova-empresa/" target="_blank">Adquirir Webi Fidelidade Empresa</a>
                    </div>
                </div>
               
            </div>
        </aside>
        <div class="container px-5">
             
           
                        
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="<?php bloginfo('template_url') ?>/img/img-dashboarOnPC.png" class="img-fluid"/>
                    </div>
                </div>
            </div>
                        
                              

            
            
            
        </div>
        
    </section>


    

    
    
<?php get_footer('sitetmpl4'); ?>