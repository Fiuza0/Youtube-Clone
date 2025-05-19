<?php

namespace motionPlay\Model;

class Score
{
    private function __construct(
        private array $listaNota,
        private float $nota
    ){
        $this->listaNota = [];
    }
    
    public function getNota(): string
    {
        return $this->nota;
    }
    public function addLista(float $nota): void{
        $this->listaNota[] = $nota;
    }
    public function calcularNota(float $nota): void
    {
        $soma = 0;
        $itens = 0;
        foreach($this->listaNota as $nota){
            $soma += $nota;
            $itens += 1; 
        }
        $this->nota = $soma/$itens;
    }
}