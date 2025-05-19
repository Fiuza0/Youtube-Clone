<?php

use motionPlay\Model\{
    Video,
    Genero,
    Score
};


 echo "Bem vindo(a) ao Motion Play\n";

 $nomeVideo = "Godfather";
 $dataPostagem = 1970;
 $nota = 8.8;
 $incluidoNoPlano = true;

 echo exibeMensagemLancamento($dataPostagem);
 echo $nomeFilme;
$video = ["nome:" => "Up! Altas Aventuras",
         "lançamento"=> "2010",
         "nota"=> "9.2",
         "incluido"=> "true"
];
 $videoJson = json_encode($video);

 file_put_contents(__DIR__."/video.json",$videoJson);

 var_dump(lerVideos(__DIR__."/video.json")); 