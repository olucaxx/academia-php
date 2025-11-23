<?php

namespace Trabalho\AcademiaPhp\Menu;

use Trabalho\AcademiaPhp\Equipamento;

function menu(array &$equipamentos): void {
    while (true) {
        linha();
        echo "MENU MÁQUINAS\n";
        listarEquipamentos($equipamentos);
        echo "1) Adicionar máquina\n";
        echo "2) Ativar máquina\n";
        echo "3) Desativar máquina\n";
        echo "4) Remover máquina\n";
        echo "0) Voltar\n";
        $op = ler("Opção: ");
        switch ($op) {
            case '1':
                $nome = ler("Nome do equipamento: ");
                $ativ = strtolower(ler("Ativo? (s/n): "));
                $ativo = ($ativ === 's' || $ativ === 'S');
                $equip = new Equipamento($nome, $ativo);
                $equipamentos[] = $equip;
                echo "Equipamento adicionado.\n";
                pausar();
                break;
            case '2':
                listarEquipamentos($equipamentos);
                $idx = ler("Índice para ativar: ");
                if ($idx === '' || !is_numeric($idx) || !array_key_exists((int)$idx, $equipamentos)) {
                    echo "Índice inválido.\n";
                    pausar();
                    break;
                }
                $equipamentos[(int)$idx]->setAtivo(true);
                echo "Equipamento ativado.\n";
                pausar();
                break;
            case '3':
                listarEquipamentos($equipamentos);
                $idx = ler("Índice para desativar: ");
                if ($idx === '' || !is_numeric($idx) || !array_key_exists((int)$idx, $equipamentos)) {
                    echo "Índice inválido.\n";
                    pausar();
                    break;
                }
                $equipamentos[(int)$idx]->setAtivo(false);
                echo "Equipamento desativado.\n";
                pausar();
                break;
            case '4':
                listarEquipamentos($equipamentos);
                $idx = ler("Índice para remover: ");
                if ($idx === '' || !is_numeric($idx) || !array_key_exists((int)$idx, $equipamentos)) {
                    echo "Índice inválido.\n";
                    pausar();
                    break;
                }
                unset($equipamentos[(int)$idx]);
                $equipamentos = array_values($equipamentos);
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