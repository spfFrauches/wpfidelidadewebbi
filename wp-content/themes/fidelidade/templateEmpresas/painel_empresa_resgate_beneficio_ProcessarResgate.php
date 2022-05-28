<?php 
/* Template Name: Painel Empresa -Processar  Resgate Beneficio */ 
$_SESSION['url_referencia'] = 'painel-empresa-resgate-pontos';
get_header('painel');

include( get_template_directory() . '/models/model_marcacao.php' );

if (isset($_POST['pontosGastos']) ):    
    $descontar = descontarSaldo_ResgateBeneficio($_POST['pontosGastos'], $_POST['cpfCliente'], $_SESSION['dados_empresa'][0]->cnpj);
    echo "<script>window.location.href='painel-empresa-resgate-pontos'</script>";
endif;

get_footer('painel');

?>



