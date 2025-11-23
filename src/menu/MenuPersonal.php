<?php

namespace Trabalho\AcademiaPhp\Menu;

use \Trabalho\AcademiaPhp\Personal;
use \Trabalho\AcademiaPhp\Aluno;
use \Trabalho\AcademiaPhp\Treino;

function menuPersonal(Dados $dados): void {
    while (true) {
        linha();
        echo "MENU PERSONAL\n";
        listarPersonals($dados->getPersonais());
        echo "[Enter para voltar]\n";
        $idx = ler("Digite o índice do instrutor para logar como instrutor: ");
        if ($idx === '') return;
        if (!is_numeric($idx) || !array_key_exists((int)$idx, $dados->getPersonais())) {
            echo "Instrutor inválido.\n";
            pausar();
            continue;
        }
        $personal = ($dados->getPersonais())[(int)$idx];
        menuSelecionado($personal, $dados);
    }
}

function menuSelecionado(Personal $personal, Dados $dados): void {
    while (true) {
        linha();
        echo "Personal: " . $personal->getNome() . "\n";
        echo "1) Cadastrar aluno\n";
        echo "2) Remover aluno\n";
        echo "3) Cancelar plano de aluno\n";
        echo "4) Editar ficha de treino p/ aluno\n";
        echo "5) Menu equipamentos\n";
        echo "6) Informações do personal\n";
        echo "0) Voltar\n";
        $op = ler("Opção: ");
        switch ($op) {
            case '1':
                cadastrarAluno($dados);
                break;
            case '2':
                retirarAluno($dados);
                break;
            case '3':
                cancelarPlanoAluno($dados);
                break;
            case '4':
                editarFicha($dados);
                break;
            case '5':
                menuEquipamentos($dados);
                break;
            case '6':
                echo $personal->pegarDadosPessoais() . "\n";
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

function cadastrarAluno(Dados $dados): void {
    linha();
    echo "CADASTRAR ALUNO\n";
    $cpf = lerSomenteNumeros("CPF (somente números): ");
    $nome = ler("Nome: ");
    $telefone = lerSomenteNumeros("Telefone (somente números: ");
    $endereco = ler("Endereço: ");
    $email = ler("Email: ");
    $matricula = lerSomenteNumeros("Matrícula (somente números): ");
    $valorPlano = lerSomenteNumeros("Valor do plano (ex: 120.00): ");
    $aluno = new Aluno($cpf, $nome, $telefone, $endereco, $email, $matricula, $valorPlano, new \DateTime(), new \DateTime());
    $dados->adicionarAluno($aluno);
    echo "Aluno cadastrado com sucesso.\n";
    pausar();
}

function retirarAluno(Dados $dados): void {
    linha();
    echo "REMOVER ALUNO\n";
    listarAlunos($dados->getAlunos());
    $idx = ler("Índice do aluno a remover (vazio para cancelar): ");
    if ($idx === '') return;
    if (!is_numeric($idx) || !array_key_exists((int)$idx, $dados->getAlunos())) {
        echo "Índice inválido.\n";
        pausar();
        return;
    }
    $dados->removerAluno((int)$idx);
    echo "Aluno removido.\n";
    pausar();
}

function cancelarPlanoAluno(Dados $dados): void {
    linha();
    echo "CANCELAR PLANO DO ALUNO\n";
    listarAlunos($dados->getAlunos());
    $idx = ler("Índice do aluno (vazio para cancelar): ");
    if ($idx === '') return;
    if (!is_numeric($idx) || !array_key_exists((int)$idx, $dados->getAlunos())) {
        echo "Índice inválido.\n";
        pausar();
        return;
    }
    ($dados->getAlunos())[(int)$idx]->cancelarPlano();
    echo "Plano cancelado para o aluno.\n";
    pausar();
}

function editarFicha(Dados $dados): void {
    linha();
    echo "EDITAR FICHA DE TREINO\n";
    listarAlunos($dados->getAlunos());
    $idx = ler("Indice do aluno (vazio para cancelar): ");
    if ($idx === '') return;
    if (!is_numeric($idx) || !array_key_exists((int)$idx, $dados->getAlunos())) {
        echo "Índice inválido.\n";
        pausar();
        return;
    }
    $aluno = ($dados->getAlunos())[(int)$idx];
    $ficha = $aluno->getFicha();

    while (true) {
        linha();
        echo "Editar ficha - Aluno: " . $aluno->getNome() . "\n";
        mostrarFicha($ficha);
        echo "1) Adicionar exercício\n";
        echo "2) Remover exercício\n";
        echo "0) Voltar\n";
        $op = ler("Opção: ");
        if ($op === '0') return;
        if ($op === '1') {
            $dia = escolherDia();
            if ($dia === null) { pausar(); continue; }

            $nomeEx = ler("Nome do exercício (ex: Puxada) : ");
            echo "Tipos de exercício disponíveis:\n";
            $keys = array_keys($dados->getExercicioTipos());
            foreach ($keys as $i => $k) {
                echo "[$i] $k\n";
            }
            while (true) {
                $tipoIdx = lerSomenteNumeros("Escolha o tipo (número): ");
                if (!array_key_exists($tipoIdx, $keys)) {
                    echo "Tipo inválido.\n";
                    pausar();
                    continue;
                }
                break;
            }
            $tipoClass = $dados->getExercicioTipos()[$keys[$tipoIdx]];
            $tipoObj = new $tipoClass();

            $equipObj = null;
            $associarEquip = false;
            while (true) {
                $usarEquip = strtolower(ler("Deseja associar um equipamento? (s/n): "));
                if ($usarEquip !== 's' && $usarEquip !== 'n') {
                    echo "Opção inválida!\n";
                    continue;
                }
                $associarEquip = $usarEquip == 's';
                break;
            }
            if ($associarEquip) {
                while (true) {
                    listarEquipamentos($dados->getEquipamentos());
                    if (empty($dados->getEquipamentos())) {
                        break;
                    }
                    $eidx = lerSomenteNumeros("Escolha o índice do equipamento (Enter para cancelar): ");
                    if($eidx == '') {
                        echo "Nenhum equipamento será associado.\n";
                        break;
                    }
                    if (!is_numeric($eidx) || !array_key_exists((int)$eidx, $dados->getEquipamentos())) {
                        echo "Índice inválido.\n";
                        continue;
                    }
                    $equipObj = $dados->getEquipamentos()[(int)$eidx]; 
                    break;
                }
            }

            $series = lerSomenteNumeros("Número de séries: ");
            $reps = lerSomenteNumeros("Número de repetições: ");
            $desc = lerSomenteNumeros("Tempo de descanso (segundos): ");

            $treino = new Treino($nomeEx, $tipoObj, $equipObj, $series, $reps, $desc);
            $ficha->adicionarTreino($dia, $treino);

            echo "Treino adicionado.\n";
            pausar();
        } elseif ($op === '2') {
            $dia = escolherDia();
            if ($dia === null) { 
                pausar(); 
                continue; 
            }
            $treinos = $ficha->getTreinos()[$dia];
            if (empty($treinos)) {
                echo "Nenhum treino nesse dia.\n";
                pausar();
                continue;
            }
            foreach ($treinos as $i => $t) {
                echo "[$i] " . $t->detalhes() ."\n";
            }
            while (true) {
                $ridx = ler("Índice do treino a remover (vazio para cancelar): ");
                if ($ridx === '') continue 2;
                if (!is_numeric($ridx) || !isset($treinos[(int)$ridx])) {
                    echo "Índice inválido.\n";
                    pausar();
                    continue;
                }
                break;
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