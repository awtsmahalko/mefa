<?php

define('BASE_URL', 'http://localhost/mefa/');
define("BASE_PATH", __DIR__ . "/../");

/*define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DBNAME", "mefa_db");*/

define("HOST", "localhost");
define("USER", "u981310152_mefa_root");
define("PASSWORD", "Mefa211!");
define("DBNAME", "u981310152_mefa_db");


session_start();

spl_autoload_register(function ($class) {

    include __DIR__ . '/autoloader.php';

    if (array_key_exists($class, $classes)) {
        require_once $classes[$class];
    }
});
