<?php 
    $urlCadastroCliente = get_bloginfo('url')."/novo-cliente";
    $urlCadastroEmpresa = get_bloginfo('url')."/nova-empresa";
    $urlLoginPainel = get_bloginfo('url')."/painel";   
?>

<!-- Modal Para Efeito de Load Apenas -->
<div class="modal fade" id="modalLoad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
        <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none" >
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div> 
                <div class="col-lg-12 text-center">
                    <p class="text-light" style="font-size: 18px">Carregando, por favor aguarde</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Para Efeito de Load Apenas -->
<div class="modal fade" id="modalLoadSair" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
        <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none" >
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div> 
                <div class="col-lg-12 text-center">
                    <p class="text-light" style="font-size: 18px">Encerrando, por favor aguarde</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    /* tempo em milisegundos */
    const TEMPOPADRAO = 3000;
       
    $(".btnSairPainel").click(function(){    
        $('#modalLoadSair').modal('show');
        setTimeout(function() {
            $('#modalLoad').modal('hide');
        }, TEMPOPADRAO);
    });

    /* ------------------------------------------------------------------------------ */
    /* Efeito de Loads                                              */
    /* ------------------------------------------------------------------------------ */
      
     $(".btn-nav-forload").click(function(){    
        $('#modalLoad').modal('show');
        setTimeout(function() {
            $('#modalLoad').modal('hide');
        }, TEMPOPADRAO);
    });
    
      
    
</script>


