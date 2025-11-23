<?php

namespace Trabalho\AcademiaPhp\Menu;

use Trabalho\AcademiaPhp\Aluno;

function menuAluno(array &$alunos, array &$equipamentos): void {
    while (true) {
        linha();
        echo "MENU ALUNO\n";
        listarAlunos($alunos);
        echo "[Vazio para voltar]\n";
        $idx = ler("Digite o índice do aluno para gerenciar: ");
        if ($idx === '') return;
        if (!is_numeric($idx) || !array_key_exists((int)$idx, $alunos)) {
            echo "Aluno inválido.\n";
            pausar();
            continue;
        }
        $aluno = $alunos[(int)$idx];
        menuAlunoSelecionado($aluno, $equipamentos);
    }
}

function menuAlunoSelecionado(Aluno $aluno, array &$equipamentos): void {
    while (true) {
        linha();
        echo "Aluno: " . $aluno->getNome() . " | Matrícula: " . $aluno->getMatricula() . PHP_EOL;
        echo "1) Treinar\n";
        echo "2) Pagar mensalidade (renovar)\n";
        echo "3) Cancelar plano\n";
        echo "4) Consultar dados pessoais + plano\n";
        echo "5) Ver ficha de treino\n";
        echo "0) Voltar\n";
        $op = ler("Opção: ");
        switch ($op) {
            case '1':
                executarRotinaTreino($aluno, $equipamentos);
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
                echo $aluno->pegarDadosPessoais() . PHP_EOL;
                pausar();
                break;
            case '5':
                $ficha = $aluno->getTreino();
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

function executarRotinaTreino(Aluno $aluno, array &$equipamentos): void {
    // Verifica plano ativo
    if (!$aluno->getPlanoAtivo()) {
        echo "Plano inativo, impossível treinar.\n";
        pausar();
        return;
    }

    $ficha = $aluno->getTreino();
    if (!$ficha) {
        echo "Aluno não possui ficha de treino.\n";
        pausar();
        return;
    }

    // escolher dia
    $dia = escolherDia();
    if ($dia === null) { pausar(); return; }

    $treinos = $ficha->getTreinos()[$dia];
    if (empty($treinos)) {
        echo "Nenhum treino cadastrado para este dia.\n";
        pausar();
        return;
    }

    foreach ($treinos as $tIndex => $treino) {
        linha();
        echo "Treino [$tIndex]:\n";
        echo $treino->detalhes() . PHP_EOL;

        $equip = $treino->getEquipamento();
        if ($equip !== null) {
            // Verifica se o equipamento está no array global e se está ativo
            $equipEncontrado = null;
            foreach ($equipamentos as $e) {
                if ($e->getNome() === $equip->getNome()) {
                    $equipEncontrado = $e;
                    break;
                }
            }
            if ($equipEncontrado === null) {
                echo "Equipamento associado não está cadastrado na academia. Impossível executar este exercício.\n";
                continue;
            }
            if (!$equipEncontrado->getAtivo()) {
                echo "Equipamento '{$equipEncontrado->getNome()}' está inativo. Impossível executar este exercício.\n";
                continue;
            }
        }

        $series = $treino->getSeries();
        $reps = $treino->getRepeticoes();
        $desc = $treino->getDescanso();

        for ($s = 1; $s <= $series; $s++) {
            echo "Série {$s}/{$series} - Repetições: {$reps}\n";
            // Apenas imprimir a mensagem polimórfica conforme sua escolha F2
            echo $treino->getTipo()->treinar();
            if ($s < $series) {
                $enter = readline("Pressione Enter para próxima série (descanso {$desc}s)...");
            } else {
                readline("Série finalizada. Pressione Enter para continuar...");
            }
        }
    }

    echo "Treino do dia finalizado.\n";
    pausar();
}

function mostrarFicha(FichaTreino $ficha): void {
    $treinos = $ficha->getTreinos();
    foreach ($treinos as $dia => $arr) {
        echo strtoupper($dia) . ":\n";
        if (empty($arr)) {
            echo "  (vazio)\n";
            continue;
        }
        foreach ($arr as $i => $t) {
            echo "  [$i] " . $t->detalhes() . PHP_EOL;
        }
    }
}