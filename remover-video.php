<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = $_GET['id'];

$repository = new \Alura\Mvc\Repository\VideoRepository($pdo);
$result = $repository->remove($id);

if ($result === false) {
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}
