<?php

namespace motionPlay;

use motionPlay\Model\{
    Video,
    Genero,
    Score,
};
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
function criaVideos(string $nome, int $dataPostagem, float $nota, Genero $genero, array $listaNota): Video {
    $score = new Score($listaNota, $nota);
    $score->addLista($nota);
    $video = new Video($nome,$dataPostagem,$score, $genero);
    
    return $video;
}
