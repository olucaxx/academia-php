<?php

namespace Academia\Poo;

class Exercicio {
    protected string $nome;
    protected string $musculoAlvo;
    protected Equipamento $equipamento;

    public function __construct(string $nome, string $musculoAlvo, Equipamento $equipamento) {
        $this->nome = $nome;
        $this->musculoAlvo = $musculoAlvo;
        $this->equipamento = $equipamento;
    }

    public function consultarExercicio(): string {
        return "$this->nome | $this->musculoAlvo | " . $this->equipamento->pegarNome();
    }
}