<?php

require_once __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// var_dump($_ENV["DB_NAME"], $_ENV["DB_USER"]);

require_once 'init.php';
require_once 'config/app.php';
new App();
?>