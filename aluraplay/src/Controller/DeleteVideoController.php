<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class DeleteVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); //pego o id
        if ($id === null || $id === false) { //valido ele
            header('Location: /?sucesso=0');
            return;
        }

        $success = $this->videoRepository->remove($id); //chamo o metodo do remove do meu repositorio
        if ($success === false) {
            header('Location: /?sucesso=0'); //envio um cabeçalho com Location que redireciona o usuario para a pagina inicial. Não é o php que redireciona o usuario, é o proprio navegador, quando ele interpreta ele cabeçalho
        } else {
            header('Location: /?sucesso=1');
        }
    }

}