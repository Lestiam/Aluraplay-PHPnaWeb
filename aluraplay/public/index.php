<?php

declare(strict_types=1);

use Alura\Mvc\Controller\{
    Controller,
    DeleteVideoController,
    EditVideoController,
    Error404Controller,
    NewVideoController,
    VideoFormController,
    VideoListController
};
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php'; //se eu etnho um arquivo do php que retorna algo, como nesse caso, então quando eu fizer o require dele, esse require vai retornar o valor que este arquivo retornou. O que tiver na classe routes, vai vir pra variavel routes

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo); //é a minha dependencia

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/'; //path_info = a server mas se ele não existir, vai ser igual a / padrão
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";
if (array_key_exists($key, $routes)) { //se a minha definição de rota existir.... eu faço isso
    $controllerClass = $routes["$httpMethod|$pathInfo"]; //o que tiver dentro de routes $httpMethod|$pathInfo, vai retornar uma string que vai ter a classe do controller

    $controller = new $controllerClass($videoRepository); //todos os meus controller precisam do videoRepository
} else {
    $controller = new Error404Controller();
}
/** @var Controller $controller */
$controller->processaRequisicao();

