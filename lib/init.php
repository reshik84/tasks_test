<?php

spl_autoload_register(function ($class){
    $filename = str_replace('\\', '/', $class) . '.php';
    if(!file_exists($filename)){
        throw new \Exception('Controller no found', 404);
    }
    include($filename);
});

define('dns', 'mysql:host=localhost;dbname=tasks');
define('db_user', 'user');
define('db_pass', '1');
