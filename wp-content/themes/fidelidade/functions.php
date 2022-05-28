<?php

function register_my_session() {
    if(!session_id()) {
        session_start();
    }
}

add_action('init', 'register_my_session');

function add_query_vars_empresa($aVars) {
    $aVars[] = "slug_empresa";
    return $aVars;
}

add_filter('query_vars', 'add_query_vars_empresa');

function add_rewrite_rules_empresa($aRules) {
    
    $aNewRules = [
        'empresa/([^/]+)?$' => 'index.php?pagename=empresa&slug_empresa=$matches[1]',
    ];
    $aRules = $aNewRules + $aRules;
    return $aRules;
}

add_filter('rewrite_rules_array', 'add_rewrite_rules_empresa');

