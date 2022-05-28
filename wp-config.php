<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wpfidelidadewebbi' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '102030' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'z=*f]@R)abu7)TcQjwv9:Yc`OCOY)S?Op+LPMx;YEdeYrUNUm|``!teSNS8^7Yx<' );
define( 'SECURE_AUTH_KEY',  'TMMCksR._DT$UzO}N<KY*&8zniYABB<YD<r| bWVOd}.VS0wOK|a.N{ZN=SK3XY@' );
define( 'LOGGED_IN_KEY',    'bY{K3#+$aUFIpfz_x7{q`nHC:8T8EtlmvI/:_ETdJQ$Dfp-F+V;.KRv6.|x@^6k-' );
define( 'NONCE_KEY',        'aLJBFkc}Ba)o<h%Q!T}~|?]}l uaB$T!lyQbHMqmcxJ^L8NvJ>VO2Wj2>-t6eQW!' );
define( 'AUTH_SALT',        'hG]LjFa1n^QFYnVQ<.TaYduW|C?p}44C*<AxXD7;qb:$*R2bd^oa_E:g-SYWr%Zb' );
define( 'SECURE_AUTH_SALT', '_}OJ79%qa>N/|78jsjb`tD/ gT2&b/Q44D4X;cm}I }!0`D |DBS4u{d)xJ^D$r/' );
define( 'LOGGED_IN_SALT',   'N$,XqVX:lc9vA=-B3?w^c/+b :2jPXD5a DWut#/it7w d>[HmH**s#;O1MDN,}9' );
define( 'NONCE_SALT',       'e**>}Mx/a.x k{MWrO`VSaoYNM$;}tOXrS/6.&(nJ?Gfo6>32~ItME%mgg_pts=,' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'fid_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
