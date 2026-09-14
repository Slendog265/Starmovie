<?php

$config_file = __DIR__ . '/config.local.php';
if (is_file($config_file)) {
    require $config_file;
}

$database_host = defined('STARMOVIE_DB_HOST') ? STARMOVIE_DB_HOST : (getenv('STARMOVIE_DB_HOST') ?: 'localhost');
$database_name = defined('STARMOVIE_DB_NAME') ? STARMOVIE_DB_NAME : (getenv('STARMOVIE_DB_NAME') ?: 'starxmovie');
$database_user = defined('STARMOVIE_DB_USER') ? STARMOVIE_DB_USER : (getenv('STARMOVIE_DB_USER') ?: 'root');
$database_password = defined('STARMOVIE_DB_PASSWORD') ? STARMOVIE_DB_PASSWORD : (getenv('STARMOVIE_DB_PASSWORD') ?: '');
$database_port = defined('STARMOVIE_DB_PORT') ? STARMOVIE_DB_PORT : (getenv('STARMOVIE_DB_PORT') ?: '3306');

$database_dsn = "mysql:host={$database_host};port={$database_port};dbname={$database_name};charset=utf8mb4";
