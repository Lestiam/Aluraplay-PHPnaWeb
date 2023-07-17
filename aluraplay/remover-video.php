<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = $_GET['id'];
$sql = 'DELETE FROM videos WHERE id = ?';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $id);

if ($statement->execute() === false) {
    header('Location: /index.php?sucesso=0'); //envio um cabeçalho com Location que redireciona o usuario para a pagina inicial. Não é o php que redireciona o usuario, é o proprio navegador, quando ele interpreta ele cabeçalho
} else {
    header('Location: /index.php?sucesso=1');
}