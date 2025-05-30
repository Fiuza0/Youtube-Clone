<?php

namespace Fiuza0\YoutubeClone\Domain\Model;

use DateTimeImmutable;

class Video
{
    
    private function __construct(
        public readonly ?int $id,
        public readonly string $nome,
        public readonly DateTimeImmutable $dataPostagem,
        public readonly Score $nota,
        public readonly Genero $genero
    ){
    }
 public function defineId(?int $id): void
    {
        if (!is_null($this->id)) {
            throw new \DomainException('Você só pode definir o ID uma vez');
        }

        $this->id = $id;
    }
}