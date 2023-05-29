<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
/*
Coloca em url = o valor do campo url que vem do body da rquisição, com a função
filter_input já existe uma validação, o terceiro parâmetro verifica que tipo de validação.
*/
if ($url === false) {
    header('Location: /?sucesso=0');
    exit();
}

$titulo = filter_input(INPUT_POST, 'titulo');

if ($titulo === false) {
    header('Location: /?sucesso=0');
    exit();
}

$repository = new \Alura\Mvc\Repository\VideoRepository($pdo);
$videoAdded = $repository->add(new \Alura\Mvc\Entity\Video($url,$titulo));

if ( $videoAdded === false) {
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}

