/*
$("body").on("click",".modalResgateBeneficio",function () {
    
    $.ajax({ 
            method: "POST",
            url: "../../wp-content/themes/fidelidade/ajax/painelempresa-resgateBeneficios.php",
            data: { cpf: $(this).data("cpf"), cnpj: $(this).data("modal"), funcao: 'carregarDadosBeneficio' }
        }).done(function( result ) {
            
            $(".modal-body.detalhesbeneficio").html(result); 
            
        });      
   
});
 * 
 */

