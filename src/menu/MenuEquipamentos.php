<?php

namespace Trabalho\AcademiaPhp\Menu;

use Trabalho\AcademiaPhp\Equipamento;

function menuEquipamentos(Dados $dados): void {
    while (true) {
        linha();
        echo "MENU MÁQUINAS\n";
        listarEquipamentos($dados->getEquipamentos());
        echo "1) Adicionar máquina\n";
        echo "2) Ativar máquina\n";
        echo "3) Desativar máquina\n";
        echo "4) Remover máquina\n";
        echo "0) Voltar\n";
        $op = ler("Opção: ");
        switch ($op) {
            case '1':
                $nome = ler("Nome do equipamento: ");
                while (true) {
                    $funcionando = strtolower(ler("Já está funcionando? (s/n): "));
                    if ($funcionando !== 's' && $funcionando !== 'n') {
                        echo "Opção inválida!\n";
                        continue;
                    }
                    $ativo = $funcionando == 's';
                    break;
                }
                $equip = new Equipamento($nome, $ativo);
                $dados->adicionarEquipamento($equip);
                echo "Equipamento adicionado.\n";
                pausar();
                break;
            case '2':
                alterarEstadoEquipamento(true, $dados);
                break;
            case '3':
                alterarEstadoEquipamento(false, $dados);
                break;
            case '4':
                listarEquipamentos($dados->getEquipamentos());
                $idx = ler("Índice para remover: ");
                if ($idx === '' || !is_numeric($idx) || !array_key_exists((int)$idx, $dados->getEquipamentos())) {
                    echo "Índice inválido.\n";
                    pausar();
                    break;
                }
                $dados->removerEquipamento((int)$idx);
                echo "Equipamento removido.\n";
                pausar();
                break;
            case '0':
                return;
            default:
                echo "Opção inválida.\n";
                pausar();
        }
    }
}

function alterarEstadoEquipamento(bool $estado, Dados $dados) {
    listarEquipamentos($dados->getEquipamentos());
    $idx = ler("Índice para ativar: ");
    if ($idx === '' || !is_numeric($idx) || !array_key_exists((int)$idx, $dados->getEquipamentos())) {
        echo "Índice inválido.\n";
        pausar();
        return;
    }
    ($dados->getEquipamentos())[(int)$idx]->setAtivo($estado);
    echo "Estado alterado.\n";
    pausar();
}
