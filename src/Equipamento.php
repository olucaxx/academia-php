<?php

namespace Academia\Poo;

class Equipamento { 
    protected string $nome;
    protected string $fornecedor;
    protected float $valor;
    protected string $dataAquisicao;
    protected string $dataManutencao;
    protected bool $ativo;

    public function __construct(string $nome, string $fornecedor, float $valor, string $dataAquisicao) {
        $this->nome = $nome;
        $this->fornecedor = $fornecedor;
        $this->valor = $valor;
        $this->dataAquisicao = $dataAquisicao;
        $this->dataManutencao = $dataAquisicao;
        $this->ativo = true; 
    }

    public function consultarDados(): string {
        $funcao=$this->ativo?"Funcionando":"Parado";
        return "|Nome: $this->nome\n|Fornecedor: $this->fornecedor\n|Custo: $this->valor\n|Aquisição: $this->dataAquisicao\n|Manutenção: $this->dataManutencao\n|Estado: $funcao\n";
    }

    public function realizarManutencao(string $dataManutencao) {
        $this->dataManutencao = $dataManutencao;
        $this->ativo=true;
    }

    public function desativarEquipamento() {
        $this->ativo=false;
    }

    public function pegarNome() { 
        return $this->nome;
    }
}