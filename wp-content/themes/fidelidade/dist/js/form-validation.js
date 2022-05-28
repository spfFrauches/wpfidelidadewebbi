
$(document).ready(function(){
    
  $('#cpf').mask('000.000.000-00', {reverse: false});
  $('.cpf').mask('000.000.000-00', {reverse: false});
  $('#cpf_marcacao').mask('000.000.000-00', {reverse: false});
  $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
  $('.cnpj').mask('00.000.000/0000-00', {reverse: false});
  $('.telefoneform').mask('(99)99999-9999', {reverse: false});
  $('.cepform').mask('99.999-999', {reverse: false});
  
});

