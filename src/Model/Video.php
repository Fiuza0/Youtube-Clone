<?php

namespace motionPlay\Model;

class Video
{
    private function __construct(
        public readonly string $nome,
        public readonly int $dataPostagem,
        public readonly Score $nota,
        public readonly Genero $genero
    ){
    }
}