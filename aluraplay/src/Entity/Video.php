<?php

namespace Alura\Mvc\Entity;

use http\Exception\InvalidArgumentException;

class Video
{
    public readonly int $id;
    public readonly string $url; //é uma propriedade publica que eu só posso atribuir o valor a ela uma unica vez
    public function __construct(
        string $url,
        public readonly string $title,
    ) {
        $this->setUrl($url);
    }

    private function setUrl(string $url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) { //valida se é uma url
            throw new InvalidArgumentException();
        }

        $this->url = $url; //caso contrario, eu defino minha URL com este valor
    }

    public function setId(int $id): void
    {
        $this->id = $id; //meu id é este que eu receber por parametro (inicializo)
    }
}