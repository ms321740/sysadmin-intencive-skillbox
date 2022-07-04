<?php 

define( 'DB_NAME', 'wp' );
define( 'DB_USER', 'wp' );
define( 'DB_PASSWORD', 'wp-pass' );

define( 'WP_DEBUG', false );

$table_prefix = 'wp_';

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
