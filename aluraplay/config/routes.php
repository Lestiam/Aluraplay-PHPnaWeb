<?php

return [
    'GET|/' => \Alura\Mvc\Controller\VideoListController::class,
    'GET|/novo-video' => \Alura\Mvc\Controller\VideoFormController::class, //método, url que eu vou acessar e isso vai nos dar a classe que iremos utilizar ou nosso controller
    'POST|/novo-video' => \Alura\Mvc\Controller\NewVideoController::class,
    'GET|/editar-video' => \Alura\Mvc\Controller\VideoFormController::class,
    'POST|/editar-video' => \Alura\Mvc\Controller\EditVideoController::class,
    'GET|/remover-video' => \Alura\Mvc\Controller\DeleteVideoController::class, //não é uma boa pratica utilizar o verbo GET para remover algo
];
