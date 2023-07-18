<?php

declare(strict_types=1);

if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') { //este $_SERVER serve também para ler os cabeçalhos do php, ou seja, a página ao qual estou acessando
    require_once __DIR__ . '/../listagem-videos.php';
} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once __DIR__ . '/../formulario.php';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__ . '/../novo-video.php';
    }
} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once __DIR__ . '/../formulario.php';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__ . '/../editar-video.php';
    }
} elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
    require_once __DIR__ . '/../remover-video.php';
} else {
    http_response_code(404); //envia o status 404 para a página
}


