<?php

namespace Academia\Poo;

class Equipamento { 
    protected string $nome;
    protected string $fornecedor;
    protected float $valor;
    protected string $estadoConservacao;
    protected string $dataAquisicao;
    protected string $dataManutencao;
    protected bool $ativo;

    public function consultarDados() { }
    public function realizarManutencao() { }
    public function ativarEquipamento() { }
    public function desativarEquipamento() { }
}