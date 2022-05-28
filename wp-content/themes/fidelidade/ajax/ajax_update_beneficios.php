<?php

require '../../../../wp-load.php';

include( get_template_directory() . '/models/model_beneficio.php' );

if (isset($_POST['idBeneficio'])):
    
    $vlrPts  = str_replace('.', '', $_POST['vlrPts']);
    $vlrPts  = str_replace(',', '.', $vlrPts);
    $status =  $_POST['status'];
        
    if (updateBeneficio2($_POST['idBeneficio'], $vlrPts, $status)):
        echo "updated";
    endif; 
    
endif;
