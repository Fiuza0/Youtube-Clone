<?php

use Models\Score;
use Models\Video;

function exibeMensagemLancamento(int $ano)  {
    if ($ano >= 2025) {
        return "Lançamento";
    }else if ($ano > 2023) {
        return 'filme novo';
    }else {
        return "nao é lançamento";
    }
}

function lerVideos($diretorio){
    $conteudo = file_get_contents($diretorio);
    return $arrayAssociativo = json_decode($conteudo, true);
}

require __DIR__.'/src/Models/Video.php';
require __DIR__.'/src/Models/Score.php';
function criaVideos(string $nome, int $dataPostagem, float $nota, string $genero): Video {
    $no = new Score();
    $no->addLista($nota);
    $vid = new Video($nome,$dataPostagem,$no, $genero);
    
    return $vid;
}
