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

require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo); //é a minha dependencia

if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') { //este $_SERVER serve também para ler os cabeçalhos do php, ou seja, a página ao qual estou acessando
    $controller = new VideoListController($videoRepository); //injeta a dependencia no nosso controller
} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new VideoFormController($videoRepository);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new NewVideoController($videoRepository);
    }
} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new VideoFormController($videoRepository);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new EditVideoController($videoRepository);
    }
} elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
    $controller = new DeleteVideoController($videoRepository);
} else {
    $controller = new Error404Controller($videoRepository);
}
/** @var Controller $controller */
$controller->processaRequisicao();
