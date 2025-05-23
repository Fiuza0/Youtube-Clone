<?php
use Fiuza0\YoutubeClone\Infra\conexao; 
$pdo = conexao::conectar();
$sqlTableCreator = 
'CREATE TABLE IF NOT EXISTS videos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    data_postagem INTEGER NOT NULL,
    nota REAL NOT NULL,
    genero TEXT NOT NULL
)



';


$pdo->exec($sqlTableCreator);