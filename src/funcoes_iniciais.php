<?php

use Fiuza0\YoutubeClone\Domain\Model\{
    Video,
    Genero,
    Score,
};
use Fiuza0\YoutubeClone\Domain\Repository\VideoRepository;
use Fiuza0\YoutubeClone\Infra\conexao;
use Fiuza0\YoutubeClone\Infra\Repository\PdoVideoRepository;

function exibeMensagemLancamento(int $ano) 
{
    if ($ano >= 2025) {
        return "Lançamento";
    }else if ($ano > 2023) {
        return 'filme novo';
    }else {
        return "nao é lançamento";
    }
}

function lerVideos($diretorio)
{
    $conteudo = file_get_contents($diretorio);
    return $arrayAssociativo = json_decode($conteudo, true);
}
function criaVideos(int $id,string $nome, int $dataPostagem, float $nota, Genero $genero, array $listaNota): Video 
{
    $connection = conexao::conectar();
    $videoRepository = new PdoVideoRepository($connection);
    $score = new Score($listaNota, null);
    $score->addLista($nota);
    $video = new Video($id, $nome,$dataPostagem,$score, $genero);
    $video->defineId($id);
    try{
        $videoRepository->save($video);
    }catch(PDOException $e){
        echo $e->getMessage();
        $connection->rollBack();
    }   
    
    return $video;
}
