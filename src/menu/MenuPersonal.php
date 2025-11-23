<?php

namespace Trabalho\AcademiaPhp\Menu;

use \Trabalho\AcademiaPhp\Personal;
use \Trabalho\AcademiaPhp\Aluno;
use \Trabalho\AcademiaPhp\Treino;
use \Trabalho\AcademiaPhp\FichaTreino;

function menu(array &$alunos, array &$personals, array &$equipamentos, array &$exercicioTipos): void {
    while (true) {
        linha();
        echo "MENU INSTRUTOR\n";
        listarPersonals($personals);
        echo "[Vazio para voltar]\n";
        $idx = ler("Digite o índice do instrutor para logar como instrutor: ");
        if ($idx === '') return;
        if (!is_numeric($idx) || !array_key_exists((int)$idx, $personals)) {
            echo "Instrutor inválido.\n";
            pausar();
            continue;
        }
        $instrutor = $personals[(int)$idx];
        menuSelecionado($instrutor, $alunos, $equipamentos, $exercicioTipos);
    }
}

function menuSelecionado(Personal $instrutor, array &$alunos, array &$equipamentos, array &$exercicioTipos): void {
    global $personals;
    while (true) {
        linha();
        echo "Instrutor: " . $instrutor->getNome() . PHP_EOL;
        echo "1) Cadastrar aluno\n";
        echo "2) Remover aluno\n";
        echo "3) Cancelar plano de aluno\n";
        echo "4) Criar ficha de treino p/ aluno\n";
        echo "5) Editar ficha de treino p/ aluno\n";
        echo "6) Menu máquinas\n";
        echo "0) Voltar\n";
        $op = ler("Opção: ");
        switch ($op) {
            case '1':
                cadastrarAluno($alunos);
                break;
            case '2':
                removerAluno($alunos);
                break;
            case '3':
                cancelarPlanoAluno($alunos);
                break;
            case '4':
                criarFichaParaAluno($alunos);
                break;
            case '5':
                editarFicha($alunos, $equipamentos, $exercicioTipos);
                break;
            case '6':
                menuMaquinas($equipamentos);
                break;
            case '0':
                return;
            default:
                echo "Opção inválida.\n";
                pausar();
        }
    }
}

function cadastrarAluno(array &$alunos): void {
    linha();
    echo "CADASTRAR ALUNO\n";
    $cpf = ler("CPF: ");
    $nome = ler("Nome: ");
    $telefone = ler("Telefone: ");
    $endereco = ler("Endereço: ");
    $email = ler("Email: ");
    $matricula = (int) ler("Matrícula (número): ");
    $valorPlano = (float) ler("Valor do plano (ex: 120.00): ");
    // Note: conforme sua classe Aluno, o construtor cria dataAdesao = now e vencimento = +30 dias
    $aluno = new Aluno($cpf, $nome, $telefone, $endereco, $email, $matricula, $valorPlano, new DateTime(), new DateTime());
    $alunos[] = $aluno;
    echo "Aluno cadastrado com sucesso.\n";
    pausar();
}

function removerAluno(array &$alunos): void {
    linha();
    echo "REMOVER ALUNO\n";
    listarAlunos($alunos);
    $idx = ler("Índice do aluno a remover (vazio para cancelar): ");
    if ($idx === '') return;
    if (!is_numeric($idx) || !array_key_exists((int)$idx, $alunos)) {
        echo "Índice inválido.\n";
        pausar();
        return;
    }
    unset($alunos[(int)$idx]);
    // reorganiza índices
    $alunos = array_values($alunos);
    echo "Aluno removido.\n";
    pausar();
}

function cancelarPlanoAluno(array &$alunos): void {
    linha();
    echo "CANCELAR PLANO DO ALUNO\n";
    listarAlunos($alunos);
    $idx = ler("Índice do aluno (vazio para cancelar): ");
    if ($idx === '') return;
    if (!is_numeric($idx) || !array_key_exists((int)$idx, $alunos)) {
        echo "Índice inválido.\n";
        pausar();
        return;
    }
    $alunos[(int)$idx]->cancelarPlano();
    echo "Plano cancelado para o aluno.\n";
    pausar();
}

function criarFichaParaAluno(array &$alunos): void {
    linha();
    echo "CRIAR FICHA DE TREINO\n";
    listarAlunos($alunos);
    $idx = ler("Índice do aluno para criar a ficha (vazio para cancelar): ");
    if ($idx === '') return;
    if (!is_numeric($idx) || !array_key_exists((int)$idx, $alunos)) {
        echo "Índice inválido.\n";
        pausar();
        return;
    }
    $aluno = $alunos[(int)$idx];
    $ficha = new FichaTreino();
    $aluno->setTreino($ficha);
    echo "Ficha criada e associada ao aluno.\n";
    pausar();
}

function editarFicha(array &$alunos, array &$equipamentos, array &$exercicioTipos): void {
    linha();
    echo "EDITAR FICHA DE TREINO\n";
    listarAlunos($alunos);
    $idx = ler("Índice do aluno (vazio para cancelar): ");
    if ($idx === '') return;
    if (!is_numeric($idx) || !array_key_exists((int)$idx, $alunos)) {
        echo "Índice inválido.\n";
        pausar();
        return;
    }
    $aluno = $alunos[(int)$idx];
    $ficha = $aluno->getTreino();
    if (!$ficha) {
        echo "Aluno não possui ficha. Crie uma antes.\n";
        pausar();
        return;
    }

    while (true) {
        linha();
        echo "Editar ficha - Aluno: " . $aluno->getNome() . PHP_EOL;
        mostrarFicha($ficha);
        echo "1) Adicionar exercício\n";
        echo "2) Remover exercício\n";
        echo "0) Voltar\n";
        $op = ler("Opção: ");
        if ($op === '0') return;
        if ($op === '1') {
            // adicionar
            $dia = escolherDia();
            if ($dia === null) { pausar(); continue; }

            $nomeEx = ler("Nome do exercício (ex: Puxada) : ");
            // listar tipos disponíveis
            echo "Tipos de exercício disponíveis:\n";
            $keys = array_keys($exercicioTipos);
            foreach ($keys as $i => $k) {
                echo "[$i] $k\n";
            }
            $tipoIdx = (int) ler("Escolha o tipo (número): ");
            if (!array_key_exists($tipoIdx, $keys)) {
                echo "Tipo inválido.\n";
                pausar();
                continue;
            }
            $tipoClass = $exercicioTipos[$keys[$tipoIdx]];
            /** @var Exercicio $tipoObj */
            $tipoObj = new $tipoClass();

            // equipamento opcional
            $usarEquip = strtolower(ler("Deseja associar um equipamento? (s/n): "));
            $equipObj = null;
            if ($usarEquip === 's' || $usarEquip === 'S') {
                listarEquipamentos($equipamentos);
                $eidx = ler("Escolha índice do equipamento (vazio para cancelar associação): ");
                if ($eidx !== '' && is_numeric($eidx) && array_key_exists((int)$eidx, $equipamentos)) {
                    $equipObj = $equipamentos[(int)$eidx];
                } else {
                    echo "Nenhum equipamento será associado.\n";
                    $equipObj = null;
                }
            }

            $series = (int) ler("Número de séries: ");
            $reps = (int) ler("Número de repetições: ");
            $desc = (int) ler("Tempo de descanso (segundos): ");

            $treino = new Treino($nomeEx, $tipoObj, $equipObj, $series, $reps, $desc);
            $ficha->adicionarTreino($dia, $treino);

            echo "Treino adicionado ao dia {$dia}.\n";
            pausar();
        } elseif ($op === '2') {
            $dia = escolherDia();
            if ($dia === null) { pausar(); continue; }
            $treinos = $ficha->getTreinos()[$dia];
            if (empty($treinos)) {
                echo "Nenhum treino nesse dia.\n";
                pausar();
                continue;
            }
            foreach ($treinos as $i => $t) {
                echo "[$i] " . $t->detalhes() . PHP_EOL;
            }
            $ridx = ler("Índice do treino a remover (vazio para cancelar): ");
            if ($ridx === '') continue;
            if (!is_numeric($ridx) || !isset($treinos[(int)$ridx])) {
                echo "Índice inválido.\n";
                pausar();
                continue;
            }
            $ficha->removerTreino($dia, (int)$ridx);
            echo "Treino removido.\n";
            pausar();
        } else {
            echo "Opção inválida.\n";
            pausar();
        }
    }
}