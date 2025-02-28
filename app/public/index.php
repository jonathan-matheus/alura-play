<?php

declare(strict_types=1);

use Alura\Mvc\Controller\{
    Controller,
    Error404Controller,
};
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require_once __DIR__ . '/../config/routes.php';
$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);
$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";
if(array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    $controller = new $controllerClass($videoRepository);   
}else{
    $controller = new Error404Controller();
}

/** @var Controller $controller */
$controller->processaRequisicao();
