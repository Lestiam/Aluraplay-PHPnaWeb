<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class EditVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: /?sucesso=0');
            return;
        }

        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL); //filter_input traz um dado de algo que veio como uma requisição e esse dado vai ser filtrado baseado em uma regra que eu informar. A primeira coisa que eu vou informar é de onde vem esse dado, neste caso, vem de um POST, O SEGUNDO PARAMETRO É A VARIAVEL QUE ESTA CHEGANDO E O TERCEIRO É o FILTER_VALIDATE_URL, que já valida se o texto chegando é uma URL
        if ($url === false) {
            header('Location: /?sucesso=0');
            return; //sempre que eu for redirecionar o usuario no meio do código, além de redirecionar o usuario, eu preciso interromper a execução
        }

        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $video = new Video($url, $titulo);
        $video->setId($id);

        $success = $this->videoRepository->update($video);

        if ($success === false) {
            header('Location: /?sucesso=0'); //envio um cabeçalho com Location que redireciona o usuario para a pagina inicial. Não é o php que redireciona o usuario, é o proprio navegador, quando ele interpreta ele cabeçalho
        } else {
            header('Location: /?sucesso=1');
        }
    }
}