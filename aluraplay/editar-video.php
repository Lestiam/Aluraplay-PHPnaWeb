<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false) {
    header('Location: /index.php?sucesso=0');
    exit();
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL); //filter_input traz um dado de algo que veio como uma requisição e esse dado vai ser filtrado baseado em uma regra que eu informar. A primeira coisa que eu vou informar é de onde vem esse dado, neste caso, vem de um POST, O SEGUNDO PARAMETRO É A VARIAVEL QUE ESTA CHEGANDO E O TERCEIRO É o FILTER_VALIDATE_URL, que já valida se o texto chegando é uma URL
if ($url === false) {
    header('Location: /index.php?sucesso=0');
    exit(); //sempre que eu for redirecionar o usuario no meio do código, além de redirecionar o usuario, eu preciso interromper a execução
}

$titulo = filter_input(INPUT_POST, 'titulo');
if ($titulo === false) {
    header('Location: /index.php?sucesso=0');
    exit();
}

$sql = 'UPDATE videos SET url = :url, title = :title  WHERE id = :id;';
$statement = $pdo->prepare($sql);
$statement->bindValue(':url', $url);
$statement->bindValue(':title', $titulo);
$statement->bindValue(':id', $id, PDO::PARAM_INT);

if ($statement->execute() === false) {
    header('Location: /index.php?sucesso=0'); //envio um cabeçalho com Location que redireciona o usuario para a pagina inicial. Não é o php que redireciona o usuario, é o proprio navegador, quando ele interpreta ele cabeçalho
} else {
    header('Location: /index.php?sucesso=1');
}