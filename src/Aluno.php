<?php

namespace Academia\Poo;

class Aluno extends Pessoa {
    protected int $matricula;
    protected float $valorPlano;
    protected string $dataAdesao;
    protected string $vencimentoPlano;
    protected bool $planoAtivo;
    protected FichaTreino $treino;

    public function __construct(string $cpf, string $nome, string $dataNascimento, string $telefone, string $endereco, string $email, int $matricula, float $valorPlano, string $dataAdesao, string $vencimentoPlano) {
        parent::__construct($cpf, $nome, $dataNascimento, $telefone, $endereco, $email);
        $this->matricula = $matricula;
        $this->valorPlano = $valorPlano;
        $this->dataAdesao = $dataAdesao;
        $this->vencimentoPlano = $vencimentoPlano;
        $this->planoAtivo = true;
    }

    public function renovarPlano(string $vencimentoPlano) {
        $this->vencimentoPlano = $vencimentoPlano;
        $this->planoAtivo = true;
    }

    public function cancelarPlano() {
        $this->planoAtivo=false;
    }

    public function verificarPlano(): string { 
        $statusPlano = $this->planoAtivo?"Ativo":"Inativo";
        return "|Nome: $this->nome\n|Matricula: $this->matricula\n|Mensalidade: $this->valorPlano\n|Vencimento: $this->vencimentoPlano\n|Plano: $statusPlano\n";
    }

    public function alterarTreino(FichaTreino $treino) {
        $this->treino=$treino;
    }

    public function consultarTreinos(): array {
        return $this->treino->consultarTreinos();
    }
    
}
