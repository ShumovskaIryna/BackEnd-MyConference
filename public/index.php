<?php
use core\Router;

define('ROOT', dirname(__DIR__));

session_start();

spl_autoload_register(function ($class) {

    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

$query = $_SERVER['REQUEST_URI'];

$router = new Router($query);
$router->uploadPage();

