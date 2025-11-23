<?php

namespace Trabalho\AcademiaPhp\Menu;

use Trabalho\AcademiaPhp\Aluno;
use Trabalho\AcademiaPhp\FichaTreino;

function menuAluno(Dados $dados): void {
    while (true) {
        linha();
        echo "MENU ALUNO\n";
        listarAlunos($dados->getAlunos());
        echo "[Enter para voltar]\n";
        $idx = ler("Digite o índice do aluno para gerenciar: ");
        if ($idx === '') return;
        if (!is_numeric($idx) || !array_key_exists((int)$idx, $dados->getAlunos())) {
            echo "Aluno inválido.\n";
            pausar();
            continue;
        }
        $aluno = ($dados->getAlunos())[(int)$idx];
        menuAlunoSelecionado($aluno, $dados);
    }
}

function menuAlunoSelecionado(Aluno $aluno, Dados $dados): void {
    while (true) {
        linha();
        echo "Aluno: " . $aluno->getNome() . " | Matrícula: " . $aluno->getMatricula() ."\n";
        echo "1) Treinar\n";
        echo "2) Pagar mensalidade (renovar)\n";
        echo "3) Cancelar plano\n";
        echo "4) Consultar dados pessoais + plano\n";
        echo "5) Ver ficha de treino\n";
        echo "0) Voltar\n";
        $op = ler("Opção: ");
        switch ($op) {
            case '1':
                executarRotinaTreino($aluno, $dados->getEquipamentos());
                break;
            case '2':
                $aluno->renovarPlano();
                echo "Plano renovado com +30 dias.\n";
                pausar();
                break;
            case '3':
                $aluno->cancelarPlano();
                echo "Plano cancelado.\n";
                pausar();
                break;
            case '4':
                echo $aluno->pegarDadosPessoais() . "\n";
                pausar();
                break;
            case '5':
                $ficha = $aluno->getFicha();
                if (!$ficha) {
                    echo "Aluno não possui ficha de treino.\n";
                } else {
                    mostrarFicha($ficha);
                }
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

function executarRotinaTreino(Aluno $aluno, array $equipamentos): void {
    if (!$aluno->getPlanoAtivo()) {
        echo "Plano inativo, impossível treinar.\n";
        pausar();
        return;
    }

    $dia = escolherDia();
    if ($dia === null) { 
        pausar(); 
        return; 
    }

    $treinos = $aluno->getFicha()->getTreinos()[$dia];
    if (empty($treinos)) {
        echo "Nenhum treino cadastrado para este dia.\n";
        pausar();
        return;
    }

    foreach ($treinos as $tIndex => $treino) {
        linha();
        echo "Treino [$tIndex]:\n";
        echo $treino->detalhes() . "\n";

        $equip = $treino->getEquipamento();
        if ($equip !== null) {
            $equipEncontrado = null;
            foreach ($equipamentos as $e) {
                if ($e->getNome() === $equip->getNome()) {
                    $equipEncontrado = $e;
                    break;
                }
            }
            if ($equipEncontrado === null) {
                echo "Equipamento associado não está mais cadastrado na academia. Impossível executar o exercício.\n";
                continue;
            }
            if (!$equipEncontrado->getAtivo()) {
                echo "Equipamento '{$equipEncontrado->getNome()}' está inativo.\n";
                continue;
            }
        }

        echo $treino->getTipo()->treinar();
    }

    echo "Treino do dia finalizado.\n";
    pausar();
}

function mostrarFicha(FichaTreino $ficha): void {
    $treinos = $ficha->getTreinos();
    foreach ($treinos as $dia => $arr) {
        echo strtoupper($dia) . ":\n";
        if (empty($arr)) {
            echo "  (sem treinos)\n";
            continue;
        }
        foreach ($arr as $i => $t) {
            echo "  [$i] " . $t->detalhes();
        }
    }
}