<?php

namespace Fiuza0\YoutubeClone\Domain\Model;

class Score
{
    private function __construct(
        public readonly array $listaNota,
    ){
        $this->listaNota = [];
    }
    
    public function getNota(): string
    {
        return $this->calcularNota();
    }
    public function addLista(float $nota): void{
        $this->listaNota[] = $nota;
    }
    public function calcularNota(): float
    {
        $soma = 0;
        $itens = 0;
        foreach($this->listaNota as $nota){
            $soma += $nota;
            $itens += 1; 
        }
        $nota = $soma/$itens;
        return $nota;
    }
}