$(".detalhescliente").hide();

$("body").on("click",".modaldetalhes",function () {
    
    $(".detalhescliente").hide();
    $(".loadDetalhes").show();
     
    
     $.ajax({ 
            method: "POST",
            url: "../wp-content/themes/fidelidade/ajax/painelempresa-meusclientes.php",
            data: { cpfcliente: $(this).data("modal"), cnpjempresa: $(this).data("cnpj")  , funcao: 'carregarDadosCliente' }
        }).done(function( result ) {
            
            $(".detalhescliente").show();
            $(".loadDetalhes").hide();
            $(".modal-body.detalhescliente").html(result); 
            
        });      
   
});

