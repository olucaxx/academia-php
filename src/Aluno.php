<?php

namespace Academia\Poo;

class Aluno extends Pessoa {
    protected int $matricula;
    protected int $valorPlano;
    protected string $dataAdesao;
    public bool $planoAtivo;
    protected FichaTreino $treino;

    public function renovarPlano() { }
    public function cancelarPlano() { }
    public function verificarPlano(): string { }
    public function alterarTreino(FichaTreino $treino) { }
}
