<?php 

    require '../../../../wp-load.php';
    require ( get_template_directory() . '/models/model_empresa.php' );

    if (isset($_POST['cnpj'])) {
        $buscarEmpresa = buscarEmpresa($_POST['cnpj']);   
        if (!$buscarEmpresa){            
            echo "inexistente";
        } 
    }
    
    if (isset($_POST['email'])) {
        $buscarEmail = emailEmpresa($_POST['email']);   
        if (!$buscarEmail){            
            echo "inexistente";
        } 
    }

?>