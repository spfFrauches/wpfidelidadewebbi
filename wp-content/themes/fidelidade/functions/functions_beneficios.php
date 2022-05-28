<?php


function checkIsUpdatedBeneficios() {
       
    if (isset($_POST['acao'])):
        if ($_POST['acao'] == 'update'):
            
            updateBeneficio($_POST['id']);
            
        endif;       
    endif;
    
}
