<?php

namespace Academia\Poo;

class Personal extends Pessoa {
    protected string $cref;
    protected float $salario;
    protected array $diasTrabalho;
    protected array $diasFolga;

    public function criarFichaTreino(array $dias, array $exercicios): FichaTreino { }
    public function atribuirTreino(Aluno $aluno, FichaTreino $treino) { }
}
