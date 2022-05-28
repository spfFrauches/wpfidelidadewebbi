$("body").on("click",".btnDetalhesBeneficioBrinde",function () {        
    $.ajax({ 
        method: "POST",
        url: "../../wp-content/themes/fidelidade/ajax/ajax_extrato_cliente.php",
        data: { funcao: 'extratoCliente', cnpjemp: $(this).data("cnpjemp") } 
    }).done (function( result ) {
        $(".modal-body.detalhesBeneficioBrinde").html(result); 
    });  
});

$("body").on("click",".btn-load-solicitarRestage",function () {        
     $('.loadModalIntero').show();
});



