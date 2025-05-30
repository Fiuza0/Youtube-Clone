<?php

namespace Fiuza0\YoutubeClone\Domain\Model;

class Score
{
    private function __construct(
        public readonly ?array $listaNota,
        public readonly ?int $id
    ){
        $this->listaNota = [];
    }
    public function defineId(?int $id): void
    {
        if (!is_null($this->id)) {
            throw new \DomainException('Você só pode definir o ID uma vez');
        }
        $this->id = $id;
    }
    
    public function getNota(): string
    {
        return $this->calcularNota();
    }
    public function addLista(float $nota): void{
        if(is_null($this->listaNota)) { 
            $this->listaNota = [];
        }
        $this->listaNota[] = $nota;
    }
    private function calcularNota(): float
    {
    if($this->listaNota == [] | $this->listaNota == null){
       return 0.0;
    }    
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