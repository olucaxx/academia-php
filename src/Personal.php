<?php

namespace Academia\Poo;

class Personal extends Pessoa {
    protected string $cref;

    public function __construct(string $cpf, string $nome, string $dataNascimento, string $telefone, string $endereco, string $email, string $cref, float $salario) {
        parent::__construct($cpf, $nome, $dataNascimento, $telefone, $endereco, $email);
        $this->cref = $cref;
    }

    public function criarFichaTreino(array $dias, array $exercicios): FichaTreino {
        return new FichaTreino();
    }

    public function adicionarTreinoNaFicha(FichaTreino $ficha, string $dia, Exercicio $exercicio, int $series, int $repeticoes, int $descanso) {
        $ficha.adicionarTreino($dia, $exercicio, $series, $repeticoes, $descanso);
    }

    public function atribuirTreinoParaAluno(Aluno $aluno, FichaTreino $treino) {
        $aluno->alterarTreino($treino);
    }

    public function consultarCref(): string {
        return $this->cref;
    }
}
