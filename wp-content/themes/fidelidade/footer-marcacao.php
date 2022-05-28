        <div class="container-fluid">
            <hr/>
        </div>  

        <footer class="container-fluid" style="padding-left: 50px">

            <div class="row">

                <div class="col-4">
                   <img class="d-block mx-auto mb-4" src="<?= get_bloginfo('template_url') ?>/img/img_exemple.png" alt="" width="72" height="72">
                </div>

                <div class="col-4">
                    <h5>Ajuda</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" target="_blank" href="<?= get_bloginfo('url') ?>/novo-cliente">Cadastro de Clientes</a></li>
                        <li><a class="text-muted" href="#">Consultar cliente</a></li>
                    </ul>
                </div>
                
                <div class="col-4">
                    <h5>Site Fidelidade</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Voltar ao site</a></li>
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
        <script src="<?php bloginfo('template_url') ?>/ajax/ajax_marcacao.js"></script>
        
        <?php wp_footer(); ?>
    </body>
</html>

