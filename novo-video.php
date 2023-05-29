<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
/*
Coloca em url = o valor do campo url que vem do body da rquisição, com a função
filter_input já existe uma validação, o terceiro parâmetro verifica que tipo de validação.
*/
if ($url === false) {
    header('Location: /index.php?sucesso=0');
    exit();
}

$titulo = filter_input(INPUT_POST, 'titulo');

if ($titulo === false) {
    header('Location: /index.php?sucesso=0');
    exit();
}

$sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';

$statement = $pdo->prepare($sql);
$statement->bindValue(1, $url);
$statement->bindValue(2, $titulo);

if ($statement->execute() === false) {
    header('Location: /index.php?sucesso=0');
} else {
    header('Location: /index.php?sucesso=1');
}

