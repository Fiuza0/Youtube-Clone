<?php

$video = $_POST;
file_put_contents('video.json', json_encode($video));
header('Location: /sucesso.php?video=' . $video['nome']);