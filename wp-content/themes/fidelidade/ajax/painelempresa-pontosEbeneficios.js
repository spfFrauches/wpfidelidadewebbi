$("body").on("click",".modaldetalhesBeneficio",function () {
       
    $.ajax({ 
            method: "POST",
            url: "../../wp-content/themes/fidelidade/ajax/painelempresa-pontosEbeneficios.php",
            data: { id: $(this).data("id"), funcao: 'carregarDadosBeneficio' }
        }).done(function( result ) {
            $(".modal-body.detalhesbeneficio").html(result);            
        });      
   
});




