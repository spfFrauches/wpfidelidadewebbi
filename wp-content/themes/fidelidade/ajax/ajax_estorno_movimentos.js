$("body").on("click",".estorno-movimento",function () {
    
     $.ajax({ 
         
            method: "POST",
            url: "../../wp-content/themes/fidelidade/ajax/ajax_estorno_movimentos.php",
            data: { cpfcliente: $(this).data("modal"), idmarcacao: $(this).data("id"), cnpjemp:$(this).data('empresa')}
            
        }).done(function( result ) {
            
            $(".modal-body.estornoMovimento").html(result); 
            
        });      
   
});