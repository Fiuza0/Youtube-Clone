<?php

namespace Models;

class Video
{
    private function __construct(
        public readonly string $nome,
        public readonly int $dataPostagem,
        public readonly Score $nota,
        public readonly string $genero
    ){
    }
    public function getNome(): string
    {
        return $this->nome;
    }
    public function getDataPostagem(): int {
        return $this->dataPostagem;
    }
    public function getAnoLancamento(): Score {
        return $this->nota;
    }
    public function getGenero(): string {
        return $this->genero;
    }
}