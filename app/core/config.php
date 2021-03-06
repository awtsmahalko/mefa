<?php

define('BASE_URL', 'http://localhost/mefa/');
define("BASE_PATH", __DIR__ . "/../");

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DBNAME", "mefa_db");


session_start();

spl_autoload_register(function ($class) {

    include __DIR__ . '/autoloader.php';

    if (array_key_exists($class, $classes)) {
        require_once $classes[$class];
    }
});
