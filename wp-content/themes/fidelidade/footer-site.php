
        <footer class="container">

            <div class="row">

                <div class="col-lg-4 col-12 text-left">
                   <img class="mx-auto mb-4" src="<?= get_bloginfo('template_url') ?>/img/img_exemple.png" alt="" width="72" height="72">
                </div>

                <div class="col-lg-4 col-12">
                    <h5>Seja um cliente</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="<?= get_bloginfo('url') ?>/novo-cliente">Cadastrar-me como cliente</a></li>
                        <li><a class="text-muted" href="#">Vantagens de ser um cliente </a></li>
                        <li><a class="text-muted" href="#">Cashback, brindes e muito mais!</a></li>
                        <li><a class="text-muted" href="#">Ajuda</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4 col-12">
                    <h5>Programa Fidelidade</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Como funciona o <?= NOME_APLICACAO ?>?</a></li>
                        <li><a class="text-muted" href="#">Como criar meu cartão web?</a></li>
                        <li><a class="text-muted" href="#">Planos </a></li>
                        <li><a class="text-muted" href="#">FAQ</a></li>
                    </ul>
                </div>

            </div>
        </footer>


        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        
        <script src="<?php bloginfo('template_url') ?>/dist/js/bootstrap5-1.min.js"></script>
        <script src="<?php bloginfo('template_url') ?>/dist/Mask/dist/jquery.mask.js"></script>
        <script src="<?php bloginfo('template_url') ?>/dist/js/form-validation.js"></script>   
        
        <?php include( get_template_directory() . '/functions/functions_loads.php' ); ?>
        
        <?php wp_footer(); ?>
    </body>
</html>

